from flask import Blueprint, render_template, request, redirect, url_for, flash
from models import db, Recordatorio, Cita
from datetime import datetime

recordatorios = Blueprint('recordatorios', __name__)

@recordatorios.route("/")
def home():
    recordatorios_list = Recordatorio.query.all()
    return render_template('main/recordatorios.html', recordatorios=recordatorios_list)

@recordatorios.route('/new', methods=['POST'])
def new():
    if request.method == 'POST':
        try:
            ID_C = request.form['ID_C']
            TipoRecordatorio = request.form['TipoRecordatorio']
            FechaHoraEnvío_str = request.form['FechaHoraEnvío']
            FechaHoraEnvío = datetime.strptime(FechaHoraEnvío_str, '%Y-%m-%dT%H:%M')
            Estado = request.form['Estado']

            new_recordatorio = Recordatorio(ID_C=ID_C, TipoRecordatorio=TipoRecordatorio, FechaHoraEnvío=FechaHoraEnvío, Estado=Estado)
            
            db.session.add(new_recordatorio)
            db.session.commit()

            flash("Recordatorio guardado")
            return redirect(url_for('recordatorios.home'))
        
        except Exception as e:
            db.session.rollback()
            flash(f"Error al guardar el recordatorio: {str(e)}")

    return render_template('recordatorio/add_recordatorio.html')

@recordatorios.route('/recordatorios/add')
def show_add_form():
    citas = Cita.query.all()  # Obtener todas las citas disponibles para seleccionar en el formulario
    return render_template('recordatorio/add_recordatorio.html', citas=citas)

@recordatorios.route('/update/<int:id>', methods=['POST', 'GET'])
def update(id):
    recordatorio = Recordatorio.query.get(id)
    citas = Cita.query.all()  # Asegúrate de obtener todas las citas disponibles

    if request.method == 'POST':
        try:
            recordatorio.ID_C = request.form["ID_C"]
            recordatorio.TipoRecordatorio = request.form["TipoRecordatorio"]
            FechaHoraEnvío_str = request.form['FechaHoraEnvío']
            recordatorio.FechaHoraEnvío = datetime.strptime(FechaHoraEnvío_str, '%Y-%m-%dT%H:%M')
            recordatorio.Estado = request.form["Estado"]

            db.session.commit()
            flash("Recordatorio actualizado")
            return redirect(url_for("recordatorios.home"))
        
        except Exception as e:
            db.session.rollback()
            flash(f"Error al actualizar el recordatorio: {str(e)}")

    return render_template('recordatorio/editar_recordatorio.html', recordatorio=recordatorio, citas=citas)

@recordatorios.route('/delete/<int:id>')
def delete(id):
    recordatorio = Recordatorio.query.get(id)
    db.session.delete(recordatorio)
    db.session.commit()

    flash("Recordatorio eliminado")
    return redirect(url_for('recordatorios.home'))
