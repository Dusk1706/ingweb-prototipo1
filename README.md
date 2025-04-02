# 💰 Ingenieria Web - Prototipo 1

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

Sistema profesional para la gestión de operaciones de caja en sucursales comerciales, con control de efectivo, cheques y transacciones financieras.

## 🚀 Primeros Pasos

### 📋 Prerrequisitos
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- Git (Opcional)

### 🔧 Configuración Inicial
```bash
# 1. Clonar repositorio
git clone https://github.com/Dusk1706/ingweb-prototipo1.git
cd ingweb-prototipo1

# 2. Copiar variables de entorno
cp .env.example .env

# 3. Construir y levantar contenedores
docker-compose up --build -d

# 4. Generar clave de aplicación
docker-compose exec web php artisan key:generate

# 5. Ejecutar migraciones y seeds
docker-compose exec web php artisan migrate --seed