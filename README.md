# babycare



students -> parents
schools -> hospital
classes -> children

switch hospital
create a controller
create a function in auth 

for children
create a controller
create a view
create a model

personal information
doctors
dental records
teeth development
first prints
milestones
anthropometrics
contacts
immunization
growthchart
health assessment
summary



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
	id_card VARCHAR(500)
);

create table hospitals (
 	id INT AUTO_INCREMENT PRIMARY KEY,
 	hospital VARCHAR(30) NOT NULL,
	hospital_id VARCHAR(60) NOT NULL,
	date DATETIME NOT NULL,
	user_id VARCHAR(60) NOT NULL
)

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

CREATE TABLE access_requests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id VARCHAR(60) NOT NULL,
    action VARCHAR(255),
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


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