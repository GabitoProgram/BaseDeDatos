from flask import Blueprint, render_template, request, redirect, url_for, flash
from models import Doctor, db
from datetime import datetime

doctores = Blueprint('doctores', __name__)

@doctores.route("/")
def home():
    doctores = Doctor.query.all()
    return render_template('main/doctores.html', doctores=doctores)


@doctores.route('/new', methods=['POST'])
def add_doctor():
    Nombre = request.form['Nombre']
    Especialidad = request.form['Especialidad']
    Email = request.form['Email']
    Teléfono = request.form['Teléfono']
    HorariosConsulta = request.form['HorariosConsulta']
    
    new_doctor = Doctor(Nombre=Nombre, Especialidad=Especialidad, Email=Email, Teléfono=Teléfono, HorariosConsulta=HorariosConsulta)
    
    db.session.add(new_doctor)
    db.session.commit()

    flash("Doctor guardado")

    return redirect(url_for('doctores.home'))

@doctores.route('/doctores/show_add_form')
def show_add_form():
    return render_template('doctor/add_doctor.html')

@doctores.route('/update/<int:id>', methods=['POST', 'GET'])
def update(id):
    doctor = Doctor.query.get(id)

    if request.method == 'POST':
        doctor.Nombre = request.form["Nombre"]
        doctor.Especialidad = request.form["Especialidad"]
        doctor.Email = request.form["Email"]
        doctor.Teléfono = request.form["Teléfono"]

        doctor.HorariosConsulta = request.form["HorariosConsulta"]

        db.session.commit()
        flash("Doctor actualizado")
        return redirect(url_for("doctores.home"))
    
    return render_template('doctor/editar_doctor.html', doctor=doctor)

@doctores.route('/delete/<int:id>')
def delete(id):
    doctor = Doctor.query.get(id)
    db.session.delete(doctor)
    db.session.commit()

    flash("Doctor eliminado")
    return redirect(url_for('doctores.home'))

def obtener_doctores():
    doctores = Doctor.query.all()
    return doctores
