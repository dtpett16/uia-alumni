package main

import (
	"database/sql"
	"fmt"

	_ "github.com/go-sql-driver/mysql"
)

func database() {
	fmt.Println("go MySQL")
	// Open up our database connection.
	// I've set up a database on my local machine using phpmyadmin.
	// The database is called mydb
	db, err := sql.Open("mysql", "root:SED1234ALUMNI@tcp(127.0.0.1:3306)/mydb")

	// if there is an error opening the connection, handle it
	if err != nil {
		panic(err.Error())
	}

	// defer the close till after the main function has finished
	// executing
	defer db.Close()

	fmt.Println("successfully connected ")

	// perform a db.Query insert
	insert, err := db.Query("INSERT INTO Alumni VALUES ( 1, 'Eirik', 'bachler', 'IS og Informasjons', '123456', 'hemmlig@hotmail.com', 'Kristiansand' )")

	// if there is an error inserting, handle it
	if err != nil {
		panic(err.Error())
	}
	// be careful deferring Queries if you are using transactions
	defer insert.Close()
}
