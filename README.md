# babycare



students -> parents
schools -> hospital
classes -> children

create a controller
create a view
create a model

for children{

columns = user_id, child_id, date, disabled

child_staffs -> summary

child_parents

child_dental_records -> summary

child_first_prints

child_milestones

child_anthropometrics -> summary

child_contacts 

child_health_assessments -> summary

child_immunization
}


<!-- personal information -->
doctors -> staff
dental records -> tooth development
first prints -> unchangeable
milestones
anthropometrics -> have growth chart
emergency contacts -> automatic by having the staffs details 
health logs ->  health assessment, immunization, summary




Create Database
create database if not exists babycare

Create user table

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    middle_name VARCHAR(30),
    last_name VARCHAR(30) NOT NULL,
    date DATETIME NOT NULL,
    user_id VARCHAR(60) NOT NULL,
    gender VARCHAR(6) NOT NULL,
    user_role VARCHAR(20) NOT NULL,
    password VARCHAR(255),
	image VARCHAR(500),
	id_card VARCHAR(500), 
	email VARCHAR(500),
	approve tinyint
);

create table children (
 	id INT AUTO_INCREMENT PRIMARY KEY,
 	first_name VARCHAR(30) NOT NULL,
    middle_name VARCHAR(30),
    last_name VARCHAR(30) NOT NULL,
	gender VARCHAR(6) NOT NULL,
	user_id VARCHAR(60) NOT NULL,
	child_id VARCHAR(60) NOT NULL,
	date DATETIME NOT NULL,
	image VARCHAR(500),
	birth_date DATETIME,
	blood_type VARCHAR(60),
	birth_place VARCHAR(255),
	birth_type VARCHAR(60),
	multiple VARCHAR(60),
	mother VARCHAR(255),
	father VARCHAR(255),
	delivery VARCHAR(60)
)

create table child_staffs (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id VARCHAR(60) NOT NULL,
	child_id VARCHAR(60) NOT NULL,
	disabled tinyint(1) NOT NULL,
	date DATETIME NOT NULL
)

create table child_parents (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id VARCHAR(60) NOT NULL,
	child_id VARCHAR(60) NOT NULL,
	disabled tinyint(1) NOT NULL,
	date DATETIME NOT NULL
)

Access/Authorization {
Verify medical professionals identity and allow them to enter the system
Assing doctors to babies

}

Notification {
	Immunization -> kung late na si baby
	Growth Chart -> Kapag Obese na si Baby
	Health Assessment -> possible illness ng baby
}

Security {
	add otp for login
	email pdf summary
}