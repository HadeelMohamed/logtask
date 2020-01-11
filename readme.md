First we need to set up project ,please follow the next steps
•	Create folder for the project
•	Then clone project in it
•	Create Database and the name should be "logparsingdb" or any name and change it from .env
•	Place Nasalog file inside public/NASA_access_log_Jul95 
•	Rename Nasa log file to  lookup
•	Composer Update
•	Run the Project


Then we  will run our urls  using Postman owe can run it local any approach you like more 
1- Import file in DB by run “/uploadfiletest” when file finish importing will  message “finish “will show(Code allocate in UploadFileController)
2- To return  unique visitors run “/api/json/visitors/unique” (Code allocate in ApisController)
3-To return run number of hits for each url run” “/api/json/hits” (Code allocate in ApisController)
3-To return run top hits, run” “/api/json/hits/top” (Code allocate in ApisController)


Finally Here is all Scenarios tried 
1-First Scenario(get unique visitors)
First run this sql query without adding any index
SELECT ip , COUNT(*) As count FROM logs GROUP BY ip HAVING count = 1

Query time :2.44s seconds
 Then add btree index on “ip” ,using btree index is better in this scenario 

Query took 1.453 seconds. After indexing


2-Second Scenario(get hits of each url)
First run this sql query without adding any index
SELECT url , COUNT(*) As hits FROM logs GROUP BY url 

Query time 51.11s seconds
 Then add btree index on “url” ,using btree index is better in this scenario 


 Query took  2.44 sseconds. After indexing

3-third Scenario(get top)
First run this sql query without adding any index
SELECT url , COUNT(*) As hits FROM logs GROUP BY url ORDER BY `hits` DESC

Query time :  51.17s seconds
 btree index is better in this scenario hashing indexing cant not use with order by


 Query took  5.32 seconds. After indexing


PS:My sql file allocate in DB Folder

