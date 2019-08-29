@echo off

	mysqldump --add-drop-table --skip-comments -u root --result-file="results1.sql" rm_cis
 
	mysqldump --add-drop-table --skip-comments -u root --result-file="results2.sql" bn_exp
 
	mysqldump --add-drop-table --skip-comments -u root --result-file="results3.sql" bn_users
		
	mysqldump --add-drop-table --skip-comments -u root --result-file="results4.sql" inv_sch
		
	mysqldump --add-drop-table --skip-comments -u root --result-file="results5.sql" budget
	