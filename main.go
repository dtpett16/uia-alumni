package main

import (
	"fmt"
	"html/template"
	"log"
	"net/http"
)

var tpl *template.Template

func init() {
	tpl = template.Must(template.ParseGlob("templates/*.html"))
}
func main() {
	http.HandleFunc("/", idx)
	http.HandleFunc("/about", abot)
	http.HandleFunc("/contact", cntct)
	http.HandleFunc("/apply", aply)
	http.ListenAndServe(":8080", nil)
}

func idx(w http.ResponseWriter, req *http.Request) {
	err := tpl.ExecuteTemplate(w, "index.html", nil)

	if err != nil {
		log.Println(err)

		http.Error(w, "Internal server error 1", http.StatusInternalServerError)

	}
	fmt.Println("we got here")
}

func abot(w http.ResponseWriter, req *http.Request) {
	err := tpl.ExecuteTemplate(w, "about.html", nil)

	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 2", http.StatusInternalServerError)
	}
	fmt.Println("we got there")
}
func cntct(w http.ResponseWriter, req *http.Request) {
	err := tpl.ExecuteTemplate(w, "contact.html", nil)

	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 3", http.StatusInternalServerError)
	}
}
func aply(w http.ResponseWriter, req *http.Request) {
	err := tpl.ExecuteTemplate(w, "apply.html", nil)

	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 4", http.StatusInternalServerError)

	}
}
