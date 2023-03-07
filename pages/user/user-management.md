
==== FRONTEND =====
- [ ] Output PHP for the body
- [ ] Link in the js and css for the page
- [ ] Link any filters/actions for WP side of things

===== BACKEND ======
API endpoints for login and registration
This will use the dev interface for the Sign In class

- [ ] register
- [ ] login
- [ ] forgot password
- [ ] google SSO
- [ ] facebook SSO
- [ ] apple SSO
etc.

===== ADMIN =====
an area to choose what type of login system to use, JWT or WP
able to turn on SSO stuff with necessary API details

===== DT =====
A user management system more akin to the contact management system

===== FLOW =====

LOGIN
- user hits login screen
- user types in email and password
- system verifies their identity
- system logs in using WP system, or it asks for a token

OR

- user clicks SSO signin
- FE redirects user to SSO page
- FE verifies that the user is who they say they are
- FE asks backend for token
- BE verifies that auth has taken place and issues token

REGISTRATION
- user inputs details
- FE sends registration to BE
