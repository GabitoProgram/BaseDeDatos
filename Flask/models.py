from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()

class Paciente(db.Model):
    __tablename__ = 'pacientes'
    ID_P = db.Column(db.Integer, primary_key=True)
    Nombre = db.Column(db.String(100), nullable=False)
    Email = db.Column(db.String(100), nullable=False)
    Teléfono = db.Column(db.String(15), nullable=False)
    FechaNacimiento = db.Column(db.Date, nullable=False)
    Género = db.Column(db.String(10), nullable=False)
    Dirección = db.Column(db.String(255), nullable=False)

class Doctor(db.Model):
    __tablename__ = 'doctores'
    ID_D = db.Column(db.Integer, primary_key=True)
    Nombre = db.Column(db.String(100), nullable=False)
    Especialidad = db.Column(db.String(100), nullable=False)
    Email = db.Column(db.String(100), nullable=False)
    Teléfono = db.Column(db.String(15), nullable=False)
    HorariosConsulta = db.Column(db.String(255), nullable=False)

class Medico(db.Model):
    __tablename__ = 'medicos'
    ID_M = db.Column(db.Integer, primary_key=True)
    Nombre = db.Column(db.String(100), nullable=False)
    Especialidad = db.Column(db.String(100), nullable=False)
    Email = db.Column(db.String(100), nullable=False)
    Teléfono = db.Column(db.String(15), nullable=False)
    HorariosConsulta = db.Column(db.String(255), nullable=False)


class Cita(db.Model):
    __tablename__ = 'citas'
    ID_C = db.Column(db.Integer, primary_key=True)
    ID_P = db.Column(db.Integer, db.ForeignKey('pacientes.ID_P'), nullable=False)
    ID_D = db.Column(db.Integer, db.ForeignKey('doctores.ID_D'), nullable=False)
    FechaHora = db.Column(db.DateTime, nullable=False)
    Estado = db.Column(db.String(50), nullable=False)
    Motivo = db.Column(db.String(255))
    paciente = db.relationship('Paciente', backref='citas')
    doctor = db.relationship('Doctor', backref='citas')

class Recordatorio(db.Model):
    __tablename__ = 'recordatorios'
    ID_R = db.Column(db.Integer, primary_key=True)
    ID_C = db.Column(db.Integer, db.ForeignKey('citas.ID_C'), nullable=False)
    TipoRecordatorio = db.Column(db.String(10), nullable=False)
    FechaHoraEnvío = db.Column(db.DateTime, nullable=False)
    Estado = db.Column(db.String(50), nullable=False)
    cita = db.relationship('Cita', backref='recordatorios')
