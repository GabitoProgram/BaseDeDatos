from flask import Blueprint, render_template, request, redirect, url_for, flash, send_file
from models import db, Cita, Paciente, Doctor
from io import BytesIO
from reportlab.lib.pagesizes import letter
from reportlab.pdfgen import canvas

email_bp = Blueprint('email_bp', __name__)

@email_bp.route('/detalle_cita/<int:id_cita>')
def detalle_cita(id_cita):
    cita = Cita.query.get(id_cita)
    if not cita:
        return "Cita no encontrada", 404
    
    paciente = Paciente.query.get(cita.ID_P)
    doctor = Doctor.query.get(cita.ID_D)
    
    if not paciente or not doctor:
        return "Paciente o Doctor no encontrado", 404
    
    return render_template('detalle_cita.html', cita=cita, paciente=paciente, doctor=doctor)

# Ruta para imprimir la cita en PDF
@email_bp.route('/imprimir_cita/<int:id_cita>')
def imprimir_cita(id_cita):
    cita = Cita.query.get(id_cita)
    if not cita:
        return "Cita no encontrada", 404
    
    paciente = Paciente.query.get(cita.ID_P)
    doctor = Doctor.query.get(cita.ID_D)
    
    if not paciente or not doctor:
        return "Paciente o Doctor no encontrado", 404
    
    # Crear el PDF
    buffer = BytesIO()
    p = canvas.Canvas(buffer, pagesize=letter)
    width, height = letter

    # Colores y estilos
    p.setStrokeColorRGB(0, 0.4, 0.6) 
    p.setFillColorRGB(0, 0.4, 0.6)    

    p.setFont("Helvetica-Bold", 20)
    p.drawString(100, height - 80, "Recordatorio de Cita Médica")
    
    p.setFont("Helvetica", 12)
    p.drawString(100, height - 110, f"Paciente: {paciente.Nombre}")
    p.drawString(100, height - 130, f"Doctor: {doctor.Nombre}")
    p.drawString(100, height - 150, f"Especialidad: {doctor.Especialidad}")
    p.drawString(100, height - 170, f"Fecha y Hora: {cita.FechaHora.strftime('%d/%m/%Y %H:%M')}")
    p.drawString(100, height - 190, f"Motivo: {cita.Motivo}")

    # Dibujar un rectángulo alrededor de la información de la cita
    p.rect(90, height - 210, width - 180, 120, stroke=1, fill=0)
    
    # Líneas separadoras
    p.line(100, height - 210, width - 100, height - 210)
    p.line(100, height - 250, width - 100, height - 250)
    
    # Sección de contacto
    p.setFillColorRGB(0, 0, 0)  # Color de texto normal (negro)
    p.setFont("Helvetica-Bold", 12)
    p.drawString(100, height - 270, "Información de Contacto del Doctor:")
    p.setFont("Helvetica", 12)
    p.drawString(100, height - 290, f"Teléfono: {doctor.Teléfono}")
    p.drawString(100, height - 310, f"Email: {doctor.Email}")

    # Pie de página
    p.setFont("Helvetica-Oblique", 10)
    p.drawString(100, 440, "Por favor, llegue 15 minutos antes de su cita.")
    p.drawString(100, 425, "En caso de cualquier inconveniente, comuníquese con nuestro consultorio.")

    p.showPage()
    p.save()

    buffer.seek(0)
    return send_file(buffer, as_attachment=True, download_name=f"Cita_{id_cita}.pdf", mimetype='application/pdf')
