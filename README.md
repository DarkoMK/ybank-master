# Test assignment for the ycode.com developer

Hi! Are you ready to join our new team working on an innovative and exciting project? 
We are looking for a frontend, backend or full-stack developer. 
If you are not applying for a full-stack position, let us know and try to solve as much as you can.

For the test assignment, we have a partly finished banking application, where one account can send the money to the other. 
We need you to fix and finish it by paying attention to these factors:
 * **Security** - we do not want to be hacked
 
 You were using raw queries in the example provided. Yes, they are faster but not secure. I made models for the tables, made their relationships and rewrote the queries to Eloquent so you don't need to worry about escaping user input, etc. as it's already taken care of.
 Also, the migration files were missing indexes and foreign keys, I added them.
 
 * **Logic** - bank should not allow overspending your balance
 
 Implemented. The user is not allowed to make a transaction to himself and overspending is not allowed.
 
 * **Best practices** - code should be clean and easy to maintain
 
 All the logic was put into the router. It is neither clean nor easy to maintain. I made controllers and put the logic there.
 
 * **Tests** - test the parts that you feel necessary to

I wrote a few tests for the transaction API call.


---
Use small commits and descriptive commit messages while working on the assignment. One commit solving one issue.

Authentication **IS NOT** in the scope of this assignment. Getting the transactions list with the request `GET /accounts/<id>/transactions` is not a security hole.

Use this repository as your starting point but **DO NOT** fork it. Create a public repository on GitHub for your application source code, push it and send a link to jobs@ycode.com.
