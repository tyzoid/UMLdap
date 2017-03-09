<?php
if (array_key_exists('name', $_GET)) {
	$search = $_GET['name'];
	$search = preg_replace('[^a-zA-Z -]', '', $search);

	// Connect to University of Michigan's LDAP server
	$ldap = ldap_connect('ldap.umich.edu');
	ldap_bind($ldap);

	$filter = '(|(uid=*' . $search . '*)(cn=*' . $search . '*))';
	$attrs = array('cn', 'homePhone', 'mobile', 'pager', 'telephoneNumber', 'umichAltPhone', 'umichPermanentPhone', 'ou');
	$search_result = ldap_search($ldap, 'ou=People,dc=umich,dc=edu', $filter, $attrs, 0, 4);
	$entries = ldap_get_entries($ldap, $search_result);

	ldap_close($ldap);

	if (array_key_exists('getall', $_GET)) {
		echo json_encode($entries);
		die();
	}

	$people = array();
	for ($i = 0; $i < $entries['count']; $i++) {
		$entry = $entries[$i];
		$person = array();

		$name = "";
		$length = 0;
		for ($j = 0; $j < $entry['cn']['count']; $j++) {
			$tmplen = strlen($entry['cn'][$j]);
			if ($tmplen > $length) {
				$name = $entry['cn'][$j];
				$length = $tmplen;
			}
		}

		$affiliations = array('status' => array(), 'program' => array());
		for ($j = 0; $j < $entry['ou']['count']; $j++) {
			list($program, $affiliation) = explode(' - ', strtolower($entry['ou'][$j]));
			switch ($affiliation) {
				case 'student':
					if (!in_array('student', $affiliations['status'])) $affiliations['status'][] = 'student';

					$current_program = "";
					if (strncmp("minor", $program, 5) == 0) {
						$program = substr($program, 7);
						$current_program = "minor: ";
					} else {
						$current_program = "major: ";
					}

					// Programs
					$programs = array(
						'mathematics bs' => 'math',
						'computer science bs' => 'cs',
						'engineering physics bse' => 'eng. physics'
					);

					if (array_key_exists($program, $programs)) {
						$current_program .= $programs[$program];
						$affiliations['program'][] = $current_program;
					}

					break;
				case 'faculty and staff':
					if (!in_array('faculty', $affiliations['status'])) $affiliations['status'][] = 'faculty';
					break;
				case 'alumni':
					if (!in_array('alumni', $affiliations['status'])) $affiliations['status'][] = 'alumni';
					break;
			}
		}

		$person['affiliations'] = $affiliations;

		$person['name'] = $name;

		foreach (array('homePhone', 'mobile', 'pager', 'telephoneNumber', 'umichAltPhone', 'umichPermanentPhone') as $key) {
			if (array_key_exists($key, $entry) && $entry[$key]['count'] > 0) {
				$person['number'] = $entry[$key][0];
				break;
			}
		}

		$dn = array();
		foreach (explode(',', $entry['dn']) as $component) {
			list($key, $value) = explode('=', $component);
			$dn[$key] = $value;
		}

		$person['uniqname'] = $dn['uid'];

		$people[] = $person;
	}

	echo json_encode($people);
}
