# ApplicationsWebApp


# Members and Duties
#### Matthew Chuang (mchuang)
  - Styling
  - Main page and SQL table for list of users
##### Michael Beck (mubeck)
  - Styling
  - Admin page and SQL table for list of users (same as Matthew’s) and schools</li>

#### Lay Desai (ldesai)</h4>
  - Styling
  - Counselor page and SQL table for ???
#### Kevin Doherty (kdohert3)
  - Make a git repo
  - Styling
  - Student page and SQL table for schools

# Proposal Description
<p>We plan on creating a university admissions application. As of right now, there will be three types of users for the application: administrators, counselors, and students. An admin will be able to create/register counselors. Counselors will be linked to a certain school and will be able to view applications submitted to that school and make a decision (accept, reject, waitlist). Students will be able to apply to schools that are part of the University System of Maryland. Additional roles and functionality might be added later. We plan on using tools we learned (or will learn) in class (PHP, HTML, Bootstrap, Javascript, MySQL). We will use other tools if necessary. We may deploy the application to AWS if time allows.</p>  

# Parts of Website
- Styling for the entire website, preferably using Bootstrap
- Four pages

### Main page where user logs in
- Log in fields that ask what type of user you are (student, counselor, etc.)
- Students should not be able to see that Counselor or Administrator even exists.
- OPTIONAL: Email confirmation. If it’s too complicated, just forget it.

### Student page
- Fields to upload a limited number of files. Must check if they are .doc files.
- List of schools to apply to.
- Which schools have replied to their application.

### Counselor page
- Be able to see the students that applied to their school.
- Each student can be “Accepted”, “Rejected”, or “Waitlisted”.

### Administrator page
- Can create or remove counselors, other admins, and schools.
- SQL Database: admissions.
