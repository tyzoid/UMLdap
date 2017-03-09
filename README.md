# University of Michigan LDAP Search
This is a project written in PHP to perform quick searches through the University of Michigan's ldap server, with partial matches on full name or uniqname (@umich.edu email). It does this by limiting the number of records returned by the LDAP server to a small number (4), and enables real-time searching.

The mcommunity website can be slow at times, and when trying to validate data from hand-written sources, this can be a pain. Additionally, this includes a JSON API, which allows for easy extension to other applications.

## Status of the project
The project works as-is. While I would like to continue working on it (for ex, to finish processing the list of majors and minors), this project is not a big priority for me.

## License
This software is covered under the MIT license.
