package main

import (
	"html/template"
	"log"
	"net/http"
)

var tpl *template.Template

type pageData struct {
	Title       string
	FirstName   string
	DegreeLevel string
}

func init() {
	tpl = template.Must(template.ParseGlob("templates/*.html"))
}
func main() {
	http.HandleFunc("/", idx)
	http.HandleFunc("/templates/about.html", abot)
	http.HandleFunc("/templates/contact.html", cntct)
	http.HandleFunc("/templates/apply.html", aply)
	http.Handle("/favicon.ivo", http.NotFoundHandler())
	http.ListenAndServe(":8080", nil)
}

func idx(w http.ResponseWriter, req *http.Request) {

	pd := pageData{
		Title: "Index Page",
	}
	err := tpl.ExecuteTemplate(w, "index.html", pd)

	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 1", http.StatusInternalServerError)
		return
	}
}

func abot(w http.ResponseWriter, req *http.Request) {

	pd := pageData{
		Title: "About Page",
	}
	err := tpl.ExecuteTemplate(w, "about.html", pd)

	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 2", http.StatusInternalServerError)
		return
	}
}
func cntct(w http.ResponseWriter, req *http.Request) {

	pd := pageData{
		Title: "Contact Page",
	}
	err := tpl.ExecuteTemplate(w, "contact.html", pd)

	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 3", http.StatusInternalServerError)
		return
	}
}
func aply(w http.ResponseWriter, req *http.Request) {
	pd := pageData{
		Title: "Apply Page",
	}
	var first string
	var degree string
	if req.Method == http.MethodPost {
		first = req.FormValue("fname")
		degree = req.FormValue("dename")
		pd.FirstName = first
		pd.DegreeLevel = degree
	}

	err := tpl.ExecuteTemplate(w, "apply.html", pd)
	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 4", http.StatusInternalServerError)
		return
	}
}
