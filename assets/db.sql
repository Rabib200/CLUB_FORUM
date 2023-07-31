DROP DATABASE IF EXISTS uiuclub;
CREATE DATABASE IF NOT EXISTS uiuclub;
use uiuclub;

CREATE Table users(
    st_id VARCHAR(100),
    name VARCHAR(100),
    position VARCHAR(100),
    dept VARCHAR(100),
    password VARCHAR(800),
    email VARCHAR(100),
    phone VARCHAR(100),
    image_path VARCHAR(255),
    address VARCHAR(500),
    github VARCHAR(200),
    facebook VARCHAR(200),
    linkedin VARCHAR(200),
    admin_level int DEFAULT 0,
    PRIMARY KEY (email)
);

CREATE TABLE task (
    id INT AUTO_INCREMENT,
    description VARCHAR(500),
    PRIMARY KEY (id),
    assigned_to VARCHAR(100),
    FOREIGN KEY (assigned_to) REFERENCES users(email) ON DELETE CASCADE,
    title VARCHAR(200),
    assigned_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    task_date TIMESTAMP NULL,
    completed BOOLEAN
);

CREATE Table club_event(
    event_id int,
    title VARCHAR(300),
    heading VARCHAR(300),
    benefit VARCHAR(500),
    locations VARCHAR(500),
    image VARCHAR(300),
    article VARCHAR(1000),
    eligibility VARCHAR(1000),
    date_time TIMESTAMP,
    PRIMARY KEY (event_id)
);

CREATE TABLE participents(
    user_email VARCHAR(100),
    event_id INT,
    PRIMARY KEY(user_email, event_id),
    FOREIGN KEY (event_id) REFERENCES club_event(event_id) ON DELETE CASCADE,
    FOREIGN KEY (user_email) REFERENCES users(email) ON DELETE CASCADE
);

CREATE Table news(
    news_id int AUTO_INCREMENT,
    title VARCHAR(300),
    article VARCHAR(1000),
    image VARCHAR(300),
    date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (news_id)
);

CREATE TABLE problem_set(
    prblm_id int AUTO_INCREMENT,
    title VARCHAR(200),
    question VARCHAR(10000),
    date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    inputs VARCHAR(200),
    outputs VARCHAR(200),
    PRIMARY KEY (prblm_id)
);

CREATE TABLE contact (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL,
    msg VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (email) REFERENCES users (email) ON DELETE CASCADE
);

INSERT INTO `users` (`st_id`, `name`, `position`, `dept`, `password`, `email`, `phone` , `image_path`, `address`, `github`, `facebook`, `linkedin`, `admin_level`) VALUES ('011201015', 'Rabib Haque', 'Jr Secretary', 'cse', 'ee8a236efb3357c277cfc24d725be259', 'rabib@gmail.com', '01734934812' , 'assets/uploads/rabib@gmail.com.jpg', 'dhaka', 'https://github.com/rabib', 'https://www.facebook.com/rabib', 'https://www.linkedin.com/in/rabib', '1'); 
/*Admin11@*/
INSERT INTO `users` (`st_id`, `name`, `position`, `dept`, `password`, `email`, `phone` , `image_path`, `address`, `github`, `facebook`, `linkedin`, `admin_level`) VALUES ('011201141', 'Tashfia Zaman', 'Senior Secretary', 'cse', '136cc11fa7d699eb38e87f403b7f7703', 'tashfia@gmail.com', '01734934812' , 'assets/uploads/tashfia@gmail.com.jpg', 'dhaka', 'https://github.com/rashfia', 'https://www.facebook.com/tashfia', 'https://www.linkedin.com/in/tashfia', '1'); 
/*Admin00@*/
INSERT INTO `users` (`st_id`, `name`, `position`, `dept`, `password`, `email`, `phone` , `image_path`, `address`, `github`, `facebook`, `linkedin`, `admin_level`) VALUES ('011201218', 'Saiful Islam Shovon', 'Jr Secretary', 'cse', 'ee8a236efb3357c277cfc24d725be259', 'shovon@gmail.com', '01734934812' , 'assets/uploads/shovon@gmail.com.jpg', 'dhaka', 'https://github.com/shovon', 'https://www.facebook.com/shovon', 'https://www.linkedin.com/in/shovon', '1'); 
/*Admin11@*/
INSERT INTO `users` (`st_id`, `name`, `position`, `dept`, `password`, `email`, `phone`, `image_path`, `address`, `github`, `facebook`, `linkedin`, `admin_level`) VALUES ('011202037', 'Delwar Shahadat Deepu', 'Admin', 'cse', '8cf511864b8914d77548eb164896b362', 'deepu@gmail.com', '01938934819', 'assets/uploads/deepu@gmail.com.jpg', 'gazipur', 'https://github.com/deepu107', 'https://www.facebook.com/MDS.Deepu.1067', 'https://www.linkedin.com/in/delwar-shahadat-5780901a0', '2');
/*SuperUser0@*/
INSERT INTO `users` (`st_id`, `name`, `position`, `dept`, `password`, `email`, `phone`, `image_path`, `address`, `github`, `facebook`, `linkedin`, `admin_level`) VALUES ('011202037', 'Delwar Shahadat Deepu', 'general', 'cse', '3855e29b22e69434761403ce1396586e', 'deepu2@gmail.com', '01945673876', 'assets/uploads/deepu2@gmail.com.jpg', 'Gazipur', 'https://github.com/deepu107', 'https://www.facebook.com/MDS.Deepu.1067', 'https://www.linkedin.com/in/delwar-shahadat-578090', '0');
/*Genuser3@*/



INSERT INTO `problem_set` (`prblm_id`, `title`, `question`, `inputs`, `outputs`) VALUES (NULL, ' Shortest Palindrome', 'You are given a string s. You can convert s to a \r\npalindrome\r\n by adding characters in front of it.\r\n\r\nReturn the shortest palindrome you can find by performing this transformation.', 's = \"aacecaaa\"\r\ns = \"abcd\"', '\"aaacecaaa\"\r\n\"dcbabcd\"');

INSERT INTO `problem_set` (`prblm_id`, `title`, `question`, `inputs`, `outputs`) VALUES (NULL, ' Valid Anagram', 'Given two strings s and t, return true if t is an anagram of s, and false otherwise.\r\n\r\nAn Anagram is a word or phrase formed by rearranging the letters of a different word or phrase, typically using all the original letters exactly once.', 's = \"anagram\", t = \"nagaram\"\r\ns = \"rat\", t = \"car\"', 'true\r\nfalse');

INSERT INTO `problem_set` (`prblm_id`, `title`, `question`, `inputs`, `outputs`) VALUES (NULL, 'Coins', 'In Berland, there are two types of coins, having denominations of 2\r\n and k\r\n burles.\r\n\r\nYour task is to determine whether it is possible to represent n\r\n burles in coins, i. e. whether there exist non-negative integers x\r\n and y\r\n such that 2⋅x+k⋅y=n\r\n.', 'The first line contains a single integer t\r\n (1≤t≤104\r\n) — the number of test cases.\r\n\r\nThe only line of each test case contains two integers n\r\n and k\r\n (1≤k≤n≤1018\r\n; k≠2\r\n).', 'For each test case, print YES if it is possible to represent n\r\n burles in coins; otherwise, print NO. You may print each letter in any case (YES, yes, Yes will all be recognized as positive answer, NO, no and nO will all be recognized as negative answer).');

INSERT INTO `problem_set` (`prblm_id`, `title`, `question`, `inputs`, `outputs`) VALUES (NULL, 'Search in Parallel', 'Suppose you have n\r\n boxes. The i\r\n-th box contains infinitely many balls of color i\r\n. Sometimes you need to get a ball with some specific color; but you\'re too lazy to do it yourself.\r\n\r\nYou have bought two robots to retrieve the balls for you. Now you have to program them. In order to program the robots, you have to construct two lists [a1,a2,…,ak]\r\n and [b1,b2,…,bn−k]\r\n, where the list a\r\n represents the boxes assigned to the first robot, and the list b\r\n represents the boxes assigned to the second robot. Every integer from 1\r\n to n\r\n must be present in exactly one of these lists.\r\n\r\nWhen you request a ball with color x\r\n, the robots work as follows. Each robot looks through the boxes that were assigned to that robot, in the order they appear in the list. The first robot spends s1\r\n seconds analyzing the contents of a box; the second robot spends s2\r\n. As soon as one of the robots finds the box with balls of color x\r\n (and analyzes its contents), the search ends. The search time is the number of seconds from the beginning of the search until one of the robots finishes analyzing the contents of the x\r\n-th box. If a robot analyzes the contents of all boxes assigned to it, it stops searching.', 'The first line contains one integer t\r\n (1≤t≤104\r\n) — the number of test cases.\r\n\r\nEach test case consists of two lines:\r\n\r\nthe first line contains three integers n\r\n, s1\r\n, s2\r\n (2≤n≤2⋅105\r\n; 1≤s1,s2≤10\r\n);\r\nthe second line contains n\r\n integers r1,r2,…,rn\r\n (1≤ri≤106\r\n).\r\nAdditional constraint on the input: the sum of n\r\n over all test cases does not exceed 2⋅105\r\n.', 'For each test case, print two lines. The first line should contain the list a\r\n, the second line — the list b\r\n. Each list has to be printed as follows: first, print the number of elements in it, and then the elements themselves.\r\n\r\nIf there are multiple answers, you may print any of them.');

INSERT INTO `problem_set` (`prblm_id`, `title`, `question`, `inputs`, `outputs`) VALUES (NULL, 'Search in Rotated Sorted Array', 'There is an integer array nums sorted in ascending order (with distinct values).\r\n\r\nPrior to being passed to your function, nums is possibly rotated at an unknown pivot index k (1 <= k < nums.length) such that the resulting array is [nums[k], nums[k+1], ..., nums[n-1], nums[0], nums[1], ..., nums[k-1]] (0-indexed). For example, [0,1,2,4,5,6,7] might be rotated at pivot index 3 and become [4,5,6,7,0,1,2].\r\n\r\nGiven the array nums after the possible rotation and an integer target, return the index of target if it is in nums, or -1 if it is not in nums.\r\n\r\nYou must write an algorithm with O(log n) runtime complexity.', 'nums = [4,5,6,7,0,1,2], target = 0', '4');

INSERT INTO `problem_set` (`prblm_id`, `title`, `question`, `inputs`, `outputs`) VALUES (NULL, 'Permutations II', 'Given a collection of numbers, nums, that might contain duplicates, return all possible unique permutations in any order.', 'nums = [1,1,2]', '[[1,1,2],\r\n [1,2,1],\r\n [2,1,1]]'), (NULL, 'Wildcard Matching', 'Given an input string (s) and a pattern (p), implement wildcard pattern matching with support for \'?\' and \'*\' where:\r\n\r\n\'?\' Matches any single character.\r\n\'*\' Matches any sequence of characters (including the empty sequence).\r\nThe matching should cover the entire input string (not partial).', ' s = \"aa\", p = \"a\"', 'false');

INSERT INTO `problem_set` (`prblm_id`, `title`, `question`, `inputs`, `outputs`) VALUES (NULL, 'Number of Digit One', 'Given an integer n, count the total number of digit 1 appearing in all non-negative integers less than or equal to n.', 'n = 13', '6'), (NULL, 'Sliding Window Maximum', 'You are given an array of integers nums, there is a sliding window of size k which is moving from the very left of the array to the very right. You can only see the k numbers in the window. Each time the sliding window moves right by one position.\r\n\r\nReturn the max sliding window.', 'nums = [1,3,-1,-3,5,3,6,7], k = 3', '[3,3,5,5,6,7]');

INSERT INTO `problem_set` (`prblm_id`, `title`, `question`, `inputs`, `outputs`) VALUES (NULL, 'Make Array Empty', 'You are given an integer array nums containing distinct numbers, and you can perform the following operations until the array is empty:\r\n\r\nIf the first element has the smallest value, remove it\r\nOtherwise, put the first element at the end of the array.\r\nReturn an integer denoting the number of operations it takes to make nums empty.', 'nums = [3,4,-1]', '5'), (NULL, 'Add Edges to Make Degrees of All Nodes Even', 'There is an undirected graph consisting of n nodes numbered from 1 to n. You are given the integer n and a 2D array edges where edges[i] = [ai, bi] indicates that there is an edge between nodes ai and bi. The graph can be disconnected.\r\n\r\nYou can add at most two additional edges (possibly none) to this graph so that there are no repeated edges and no self-loops.\r\n\r\nReturn true if it is possible to make the degree of each node in the graph even, otherwise return false.\r\n\r\nThe degree of a node is the number of edges connected to it.', 'n = 5, edges = [[1,2],[2,3],[3,4],[4,2],[1,4],[2,5]]', 'true');

INSERT INTO `problem_set` (`prblm_id`, `title`, `question`, `inputs`, `outputs`) VALUES (NULL, 'Number of Pairs Satisfying Inequality', 'You are given two 0-indexed integer arrays nums1 and nums2, each of size n, and an integer diff. Find the number of pairs (i, j) such that', 'nums1 = [3,2,5], nums2 = [2,2,1], diff = 1', '3'), (NULL, 'Minimize XOR', 'Given two positive integers num1 and num2, find the positive integer x such that:\r\n\r\nx has the same number of set bits as num2, and\r\nThe value x XOR num1 is minimal.\r\nNote that XOR is the bitwise XOR operation.\r\n\r\nReturn the integer x. The test cases are generated such that x is uniquely determined.\r\n\r\nThe number of set bits of an integer is the number of 1\'s in its binary representation.', 'num1 = 3, num2 = 5', '3');
