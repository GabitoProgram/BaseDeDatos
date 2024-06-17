from flask import Blueprint, render_template, request, redirect, url_for, flash
from models import Cita, Paciente, Doctor, db
from datetime import datetime

citas = Blueprint('citas', __name__)

@citas.route('/')
def home():
    citas = Cita.query.all()
    return render_template('main/citas.html', citas=citas)

@citas.route('/new', methods=['GET', 'POST'])
def add_cita():
    if request.method == 'POST':
        try:
            ID_P = request.form['ID_P']
            ID_D = request.form['ID_D']
            fecha_hora = request.form['FechaHora']
            fecha_hora = datetime.strptime(fecha_hora, '%Y-%m-%dT%H:%M')
            estado = request.form['Estado']
            motivo = request.form['Motivo']

            new_cita = Cita(ID_P=ID_P, ID_D=ID_D, FechaHora=fecha_hora, Estado=estado, Motivo=motivo)

            db.session.add(new_cita)
            db.session.commit()

            flash("Cita creada exitosamente")
        except Exception as e:
            db.session.rollback()
            flash(f"Error al crear la cita: {str(e)}")
        return redirect(url_for('citas.home'))

    pacientes = Paciente.query.all()
    doctores = Doctor.query.all()
    return render_template('cita/add_cita.html', pacientes=pacientes, doctores=doctores)

@citas.route('/citas/add')
def show_add_form():
    pacientes = Paciente.query.all()
    doctores = Doctor.query.all()
    return render_template('cita/add_cita.html', pacientes=pacientes, doctores=doctores)

@citas.route('/update/<int:id>', methods=['GET', 'POST'])
def update(id):
    cita = Cita.query.get(id)
    if request.method == 'POST':
        try:
            cita.ID_P = request.form['ID_P']
            cita.ID_D = request.form['ID_D']
            fecha_hora = request.form['FechaHora']
            cita.FechaHora = datetime.strptime(fecha_hora, '%Y-%m-%dT%H:%M')
            cita.Estado = request.form['Estado']
            cita.Motivo = request.form['Motivo']

            db.session.commit()
            flash("Cita actualizada exitosamente")
        except Exception as e:
            db.session.rollback()
            flash(f"Error al actualizar la cita: {str(e)}")
        return redirect(url_for('citas.home'))

    pacientes = Paciente.query.all()
    doctores = Doctor.query.all()
    fecha_hora = cita.FechaHora.strftime('%Y-%m-%dT%H:%M')
    return render_template('cita/editar_cita.html', cita=cita, pacientes=pacientes, doctores=doctores, fecha_hora=fecha_hora)

@citas.route('/delete/<int:id>')
def delete(id):
    try:
        cita = Cita.query.get(id)
        db.session.delete(cita)
        db.session.commit()
        flash("Cita eliminada exitosamente")
    except Exception as e:
        db.session.rollback()
        flash(f"Error al eliminar la cita: {str(e)}")
    return redirect(url_for('citas.home'))

# routes/pacientes.py
def obtener_citas():
    citas = Cita.query.all()
    return citas
