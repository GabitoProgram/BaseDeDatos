from flask import Blueprint, render_template, request, redirect, url_for, flash
from models import Paciente, db
from datetime import datetime

pacientes = Blueprint('pacientes', __name__)

@pacientes.route("/")
def home():
    pacientes = Paciente.query.all()
    return render_template('main/index.html', pacientes=pacientes)

@pacientes.route('/new', methods=['POST'])
def add_paciente():
    Nombre = request.form['Nombre']
    Email = request.form['Email']
    Teléfono = request.form['Teléfono']
    FechaNacimiento = request.form['FechaNacimiento']
    
    Género = request.form['Género']
    Dirección = request.form['Dirección']

    new_paciente = Paciente(Nombre=Nombre, Email=Email, Teléfono=Teléfono, FechaNacimiento=FechaNacimiento, Género=Género, Dirección=Dirección)
    
    db.session.add(new_paciente)
    db.session.commit()

    flash("Paciente guardado")

    return redirect(url_for('pacientes.home'))

@pacientes.route('/pacientes/show_add_form')
def show_add_form():
    return render_template('paciente/add_paciente.html')

@pacientes.route('/update/<int:id>', methods=['POST', 'GET'])
def update(id):
    paciente = Paciente.query.get(id)

    if request.method == 'POST':
        paciente.Nombre = request.form["Nombre"]
        paciente.Email = request.form["Email"]
        paciente.Teléfono = request.form["Teléfono"]
        print(type(request.form["FechaNacimiento"]))
        paciente.FechaNacimiento = datetime.strptime(request.form["FechaNacimiento"], '%Y-%m-%d')
        paciente.Género = request.form["Género"]
        paciente.Dirección = request.form["Dirección"]

        db.session.commit()
        flash("Paciente actualizado")
        return redirect(url_for("pacientes.home"))
    
    return render_template('paciente/editar_paciente.html', paciente=paciente)

@pacientes.route('/delete/<int:id>')
def delete(id):
    paciente = Paciente.query.get(id)
    db.session.delete(paciente)
    db.session.commit()

    flash("Paciente eliminado")
    return redirect(url_for('pacientes.home'))

# routes/pacientes.py
def obtener_pacientes():
    pacientes = Paciente.query.all()
    return pacientes



