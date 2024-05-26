from flask import Flask, request, jsonify, render_template
import numpy as np
import random

app = Flask(__name__)

# Função para calcular a densidade espectral de energia usando a equação de Planck
def planck_equation(temperature, wavelength):
    h = 6.62607015e-34  # Constante de Planck em J*s
    c = 3.00e8          # Velocidade da luz no vácuo em m/s
    k = 1.38e-23        # Constante de Boltzmann em J/K

    numerator = 2 * h * (c ** 2)
    exponent = (h * c) / (wavelength * k * temperature)
    denominator = (wavelength ** 5) * (np.exp(exponent) - 1)

    spectral_density = numerator / denominator
    return spectral_density

# Função para simular o comportamento do osciloscópio e oscilometria
def simulate_behavior(payload):
    try:
        # Parse payload (aqui apenas exemplo simples, ajuste conforme necessário)
        data = payload.split(',')
        temperature = float(data[0])
        wavelength = float(data[1])

        # Cálculo da densidade espectral de energia
        spectral_density = planck_equation(temperature, wavelength)

        return spectral_density
    except Exception as e:
        return str(e)

@app.route('/')
def index():
    return render_template('index.php')

@app.route('/analyze', methods=['POST'])
def analyze():
    payload = request.json.get('payload')
    spectral_density = simulate_behavior(payload)
    return jsonify(spectral_density=spectral_density)

if __name__ == '__main__':
    app.run(port=5000)
