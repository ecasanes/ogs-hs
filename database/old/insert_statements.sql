INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `user_type`, `fname`, `mname`, `lname`, `age`, `gender`, `address`) VALUES
(1, 'ernest.casanes', '63f69f3c6ea97828332ce9bf86616069', 1, 'Admin 1', 'Cilocilo', 'Casanes', 24, 'male', 'Del Carmen, Iligan City'),
(2, 'ecasanes', '63f69f3c6ea97828332ce9bf86616069', 2, 'Instructor 1', 'Casanes', 'Lastname', 24, 'male', 'test'),
(3, 'ecasanes2', 'bc65f426282a1a198804b1d7602b25d4', 2, 'Instructor 2', 'Test', 'Lastname', 24, 'male', 'test'),
(4, 'abcd', '187ef4436122d1cc2f40dc2b92f0eba0', 2, 'Instructor 3', 'Hello', 'Lastname', 24, 'male', 'sfsf'),
(5, 'student', '63f69f3c6ea97828332ce9bf86616069', 3, 'Student 1', 'Casanes', 'Lastname', 13, 'male', 'sfsf'),
(6, 'student1', '5e5545d38a68148a2d5bd5ec9a89e327', 3, 'Student 1', '', 'Test', 13, 'male', 'dfsfd'),
(7, 'student2', '213ee683360d88249109c2f92789dbc3', 3, 'Student 2', '', 'Test', 12, 'male', 'lskjfsldfkj'),
(8, 'student3', '8e4947690532bc44a8e41e9fb365b76a', 3, 'Student 3', '', 'Test', 14, 'male', 'kljsdfljsdf'),
(9, 'student4', '166a50c910e390d922db4696e4c7747b', 3, 'Student 4', '', 'Test', 15, 'male', 'dsfsdf');


INSERT INTO `tbl_grade_level` (`gl_id`, `sy_start`, `sy_end`, `grade_level`) VALUES
(1, 2019, 2020, '1'),
(2, 2019, 2020, '2'),
(3, 2019, 2020, '3'),
(9, 2019, 2020, '4'),
(14, 2015, 2016, '1'),
(15, 2015, 2016, '2'),
(16, 2015, 2016, '3'),
(17, 2015, 2016, '4');


INSERT INTO `tbl_grade_section` (`offer_id`, `gl_id`, `section`) VALUES
(1, 1, 'Section 1'),
(2, 2, 'Section 2'),
(3, 3, 'Section 2'),
(4, 1, 'Section 2'),
(5, 2, 'Section 3'),
(6, 14, 'Mabuti');

INSERT INTO `tbl_subject` (`subj_id`, `subj_code`, `subj_desc`, `subj_unit`) VALUES
(1, 'CSC101', 'Computer Science 1', 3),
(2, 'Math101', 'dfdf', 3),
(3, 'Math101t', 'sfsdf', 1),
(14, 'Math101a', 'test', 1);

INSERT INTO `tbl_grade_subj` (`gl_id`, `subj_id`) VALUES
(14, 1),
(14, 2),
(14, 3),
(14, 14);