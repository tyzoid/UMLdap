<?php
/**
 * Footer Template
 *
 * Uses HTML5, but all template HTML is (should be) xHTML 1.1 compatable
 */
class Footer{
	private $scripts = array();

	/**
	 * Constructor
	 *
	 * @param string $title - the title of the page
	 * @param mixed $scripts - the url (or array of urls) of the script(s) to include
	 */
	public function __construct($title = null, $stylesheets = null){
		// Page Title
		if (! empty($title)) $this->title = $title;

		if (! empty($scripts) && is_array($scripts)) $this->scripts = array_merge($scripts, $this->scripts);
		else if (! empty($scripts)) $this->addScript($scripts);
	}

	public function setTitle($title = "Ranks"){
		$this->title = $title;
	}

	public function addScript($script){
		if (empty($script) || strncmp($script, '/', 1) !== 0) return false;

		$scripts[] = $script;
		return true;
	}

	public function output($return = false){
		// End Container
		$html .= "\t\t</div>\n";

		// Add any scripts to be included at the bottom of the page.
		foreach ($this->scripts as $script){
			echo "<script type=\"text/javascript\" src=\"$script\"></script>";
		}

		$html .= "\t</body>\n";
		$html .= "</html>\n";

		if($return === true) return $html;
		echo $html;
	}
}
