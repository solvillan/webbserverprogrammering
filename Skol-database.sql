CREATE DATABASE school;
USE school;

CREATE TABLE student (
  id int auto_increment primary key,
  email VARCHAR(50),
  address VARCHAR(100),
  fname VARCHAR(25),
  ename VARCHAR(25)
);

CREATE TABLE class (
  id int AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(20),
  teacher_name VARCHAR(50)
);

CREATE TABLE parent (
  id int AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  address VARCHAR(100),
  email VARCHAR(50),
  phone_nr VARCHAR(15)
);

CREATE TABLE student_class (
  student_id int NOT NULL ,
  class_id int NOT NULL ,
  grade CHAR
);

CREATE TABLE student_parent (
  student_id int NOT NULL ,
  parent_id INT NOT NULL
);