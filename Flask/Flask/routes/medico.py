from flask import Blueprint, render_template, request, redirect, url_for, flash
from models import Medico, db

medicos = Blueprint('medicos', __name__)

@medicos.route("/")
def home():
    medicos = Medico.query.all()
    return render_template('medicos.html', medicos=medicos)

@medicos.route('/new', methods=['POST'])
def add_medico():
    Nombre = request.form['Nombre']
    Especialidad = request.form['Especialidad']
    Email = request.form['Email']
    Teléfono = request.form['Teléfono']
    HorariosConsulta = request.form['HorariosConsulta']

    new_medico = Medico(Nombre=Nombre, Especialidad=Especialidad, Email=Email, Teléfono=Teléfono, HorariosConsulta=HorariosConsulta)
    
    db.session.add(new_medico)
    db.session.commit()

    flash("Médico guardado")

    return redirect(url_for('medicos.home'))

@medicos.route('/update/<int:id>', methods=['POST', 'GET'])
def update(id):
    medico = Medico.query.get(id)

    if request.method == 'POST':
        medico.Nombre = request.form["Nombre"]
        medico.Especialidad = request.form["Especialidad"]
        medico.Email = request.form["Email"]
        medico.Teléfono = request.form["Teléfono"]
        medico.HorariosConsulta = request.form["HorariosConsulta"]

        db.session.commit()
        flash("Médico actualizado")
        return redirect(url_for("medicos.home"))
    
    return render_template('editar_medico.html', medico=medico)

@medicos.route('/delete/<int:id>')
def delete(id):
    medico = Medico.query.get(id)
    db.session.delete(medico)
    db.session.commit()

    flash("Médico eliminado")
    return redirect(url_for('medicos.home'))
