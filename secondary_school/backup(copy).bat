//| grep -v "SET OPTION SQL_QUOTE_SHOW_CREATE" 

@echo on

mysqldump -u root managementsystem "res_id_2018_2019_first_ss 3_a" > "c:/xampp/htdocs/schoolms/secondary_school/dump/ss 3_result.sql"
