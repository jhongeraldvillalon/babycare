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
	approve tinyint,
	contact varchar(20)
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

create table child_prints (
	id INT AUTO_INCREMENT PRIMARY KEY,
	child_id VARCHAR(60) NOT NULL,
	date DATETIME NOT NULL,
	left_hand VARCHAR(500),
	right_hand VARCHAR(500),
	left_foot VARCHAR(500),
	right_foot VARCHAR(500)
)

create table child_prints (
	id INT AUTO_INCREMENT PRIMARY KEY,
	child_id VARCHAR(60) NOT NULL,
	date DATETIME NOT NULL,
	left_hand VARCHAR(500),
	right_hand VARCHAR(500),
	left_foot VARCHAR(500),
	right_foot VARCHAR(500)
)

CREATE TABLE milestones (
    id INT AUTO_INCREMENT PRIMARY KEY,
	milestone_id VARCHAR(60) NOT NULL,
    name varchar(500),
    description TEXT,
	age_range varchar(60),
	category varchar (60),
	disabled tinyint
);

CREATE TABLE milestones_tracker (
    id INT AUTO_INCREMENT PRIMARY KEY,
    child_id VARCHAR(60) NOT NULL,
    milestone_id varchar(60) NOT NULL,
    accomplished_date DATE,
	accomplished tinyint
);

-- Table for Anthropometric Data
CREATE TABLE anthropometrics (
    id INT AUTO_INCREMENT PRIMARY KEY,
	anthropometric_id varchar(60) NOT NULL,
    child_id VARCHAR(60) NOT NULL,
    date_recorded DATE,
    head FLOAT,
    head_metrics VARCHAR(20),
    chest FLOAT,
    chest_metrics VARCHAR(20),
    length FLOAT,
    length_metrics VARCHAR(20),
    weight FLOAT,
    weight_metrics VARCHAR(20),
    abdomen FLOAT,
    abdomen_metrics VARCHAR(20)
);

-- Table for Growth Chart Data
CREATE TABLE growth_chart (
    id INT AUTO_INCREMENT PRIMARY KEY,
	growth_chart_id varchar(60) NOT NULL,
    child_id VARCHAR(60) NOT NULL,
  	anthropometric_id varchar(60) NOT NULL,
    date_recorded DATE,
    length FLOAT,
    length_metrics VARCHAR(20),
    weight FLOAT,
    weight_metrics VARCHAR(20)
);

CREATE TABLE contacts ( 
	id INT AUTO_INCREMENT PRIMARY KEY,
	child_id VARCHAR(60) NOT NULL,
	contact_id varchar(60) NOT NULL,
	hospital varchar(60) NOT NULL,
	hospital_contact varchar(60) NOT NULL,
	pharmacy varchar(60) NOT NULL,
	pharmacy_contact varchar(60) NOT NULL,
	ambulance varchar(60) NOT NULL,
	ambulance_ambulance varchar(60) NOT NULL,
	poison_control_center varchar(60) NOT NULL,
	poison_control_center_contact varchar(60) NOT NULL,
	burn_center varchar(60) NOT NULL,
	burn_center_center varchar(60) NOT NULL
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