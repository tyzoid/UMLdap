# University of Michigan LDAP Search
This is a project written in PHP to perform quick searches through the University of Michigan's ldap server, with partial matches on full name or uniqname (@umich.edu email). It does this by limiting the number of records returned by the LDAP server to a small number (4), and enables real-time searching.

The mcommunity website can be slow at times, and when trying to validate data from hand-written sources, this can be a pain. Additionally, this includes a JSON API, which allows for easy extension to other applications.

## Status of the project
The project works as-is. While I would like to continue working on it (for ex, to finish processing the list of majors and minors), this project is not a big priority for me.

## MIT License
Copyright 2016-2017 Tyler Dence

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
