from flask import Flask, render_template, url_for, request, send_file
from flask_sqlalchemy import SQLAlchemy
from routes.paciente import pacientes
from routes.doctor import doctores
from routes.cita import citas
from routes.recordatorio import recordatorios
from models import db, Paciente, Doctor, Cita, Recordatorio
from routes.email import email_bp
from jinja2 import Environment
from datetime import datetime

app = Flask(__name__)
app.secret_key = "secret key"
app.config['SQLALCHEMY_DATABASE_URI'] = 'mssql+pyodbc://sa:123456@localhost/prueba3?driver=ODBC+Driver+17+for+SQL+Server'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db.init_app(app)
# Jinja
def format_date(value, format='%Y-%m-%d'):
    if isinstance(value, str):
        try:
            value = datetime.strptime(value, '%Y-%m-%d')
        except ValueError:
            return value 
    return value.strftime(format)

app.jinja_env.filters['date'] = format_date
# Blueprints
app.register_blueprint(pacientes)
app.register_blueprint(doctores, url_prefix='/doctores')
app.register_blueprint(citas, url_prefix='/citas')
app.register_blueprint(recordatorios, url_prefix='/recordatorios')
app.register_blueprint(email_bp, url_prefix='/email')

with app.app_context():
    db.create_all()

if __name__ == "__main__":
    app.run(debug=True)





