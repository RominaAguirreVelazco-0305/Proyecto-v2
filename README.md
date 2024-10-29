# Proyecto de Inversiones con IA 💸🤖

¡Bienvenido a la plataforma de microinversiones potenciadas con Inteligencia Artificial! Este proyecto ofrece una forma innovadora de realizar inversiones, basadas en el análisis de datos y recomendaciones inteligentes usando IA. A continuación encontrarás toda la información necesaria para entender y desplegar el proyecto, incluyendo cómo configurar el entorno, qué tecnologías hemos utilizado y cómo aprovechar al máximo nuestra plataforma.

## 📸 Capturas de Pantalla del Proyecto

Aquí puedes encontrar algunas capturas de pantalla que muestran la interfaz del proyecto y cómo funcionan sus principales características:

1. **Home**
   ![image](https://github.com/user-attachments/assets/17f54fbd-cc8b-4d3a-9107-3ceb49eb0dd3)


2. **Login**
  ![image](https://github.com/user-attachments/assets/47fee882-65f1-422b-a996-641fa5ccd8c0)


3. **Register**
  ![image](https://github.com/user-attachments/assets/937b2238-bba0-45e1-917b-f2d1819a6b12)


4. **Contáctanos**
   ![image](https://github.com/user-attachments/assets/2908304c-9dd3-4546-88b5-500b75d82f5a)
   

5. **Proyectos con mas inversiones**
   ![image](https://github.com/user-attachments/assets/b8f17374-07ad-4996-a0fc-85d61aaa5947)
   
   ![image](https://github.com/user-attachments/assets/be2bcc6a-1cd2-4e4a-b63e-f91e11f2b4bf)
   
   ![image](https://github.com/user-attachments/assets/8c95ee69-3aa0-48bf-b076-5972e642b57d)
   

6. **Mis inversiones creadas**
   ![image](https://github.com/user-attachments/assets/ba80e3fe-210b-4594-8f8f-6fdd93c45292)

   ![image](https://github.com/user-attachments/assets/a86d67b9-548f-42aa-bf75-2904fd83530d)


   
7. **Profile**
   ![image](https://github.com/user-attachments/assets/69d7853a-584c-4327-aacc-43757d05261b)
   

8. **Notificaciones de inversiones**
![image](https://github.com/user-attachments/assets/6e392467-2b3a-437b-83a9-8120a72a54f1)


9. **Modo Oscuro**
    ![image](https://github.com/user-attachments/assets/9a1b6c99-c402-4c0e-855c-5007849ac2d6)

10. **ChatBox**
    ![image](https://github.com/user-attachments/assets/16c73d58-3a1c-48c8-9e96-eff59d3a8812)


## 📋 Descripción del Proyecto

Este proyecto permite a los usuarios realizar microinversiones en diferentes áreas de interés. Las decisiones de inversión son potenciadas por IA, proporcionando recomendaciones personalizadas y un análisis detallado de cada oportunidad de inversión.

### Características Principales

- 📊 **Análisis de Oportunidades de Inversión**: La plataforma evalúa múltiples proyectos y presenta recomendaciones personalizadas.
- 🤖 **IA para Sugerencias**: Utilizamos GPT-3.5 y otros algoritmos para analizar los datos y sugerir las mejores oportunidades de inversión.
- 📈 **Automatización de Inversiones**: Los usuarios pueden configurar estrategias automáticas basadas en su perfil de riesgo.
- 🛠️ **Backend en Laravel**: El backend se ha desarrollado utilizando Laravel para gestionar todas las funcionalidades de negocio y la lógica de la aplicación.
- 🌐 **Frontend Dinámico**: Implementamos una interfaz amigable y moderna para la experiencia del usuario.

## 🛠️ Tecnologías Utilizadas

- **Laravel 9**: Framework PHP para el desarrollo del backend.
- **Vue.js**: Utilizado para el desarrollo de un frontend interactivo y dinámico.
- **GPT-3.5 (ChatGPT)**: Integración con la API de OpenAI para sugerencias basadas en IA.
- **MySQL**: Base de datos relacional para almacenar datos de usuarios e inversiones.
- **Guzzle HTTP Client**: Para realizar solicitudes HTTP a la API de OpenAI.
- **Docker**: Contenedor para facilitar el despliegue.
- **Heroku**: Plataforma para el despliegue en la nube del backend.

## 🚀 Despliegue del Proyecto

### Paso a Paso para Desplegar

Sigue los siguientes pasos para desplegar el proyecto en tu entorno local o en un servidor.

### 1. Clonar el Repositorio 🛳️

```sh
$ git clone https://github.com/tu-usuario/microinversiones-ia.git
$ cd microinversiones-ia
```

### 2. Configurar el Entorno 🔧

- Renombra el archivo `.env.example` a `.env`:

```sh
$ cp .env.example .env
```

- Actualiza las variables del archivo `.env` con tu configuración:
  - Configura la conexión a la base de datos (MySQL).
  - Añade las claves API para OpenAI (`OPENAI_API_KEY`).

### 3. Instalar Dependencias 🧰

Instala las dependencias de Laravel:

```sh
$ composer install
```

Instala las dependencias del frontend:

```sh
$ npm install && npm run dev
```

### 4. Generar la Clave de la Aplicación 🔑

```sh
$ php artisan key:generate
```

### 5. Migrar la Base de Datos 🗄️

Ejecuta las migraciones para crear las tablas necesarias:

```sh
$ php artisan migrate
```

### 6. Correr el Servidor Local 🚀

```sh
$ php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`.

### 7. Despliegue en Heroku ☁️

- Inicia sesión en Heroku:

```sh
$ heroku login
```

- Crea una nueva aplicación en Heroku:

```sh
$ heroku create nombre-de-tu-app
```

- Añade los archivos necesarios (Procfile, Dockerfile si es necesario) y haz un push al repositorio de Heroku:

```sh
$ git add .
$ git commit -m "Despliegue en Heroku"
$ git push heroku main
```

### 8. Configurar las Variables de Entorno en Heroku 📝

Configura las variables del archivo `.env` directamente en el panel de configuración de Heroku.

## ⚙️ Uso del Proyecto

1. **Registro de Usuario**: Los usuarios pueden registrarse para crear una cuenta y acceder a la plataforma.
2. **Explorar Proyectos de Inversión**: Los usuarios podrán ver una lista de proyectos disponibles con información detallada.
3. **Recibir Recomendaciones de IA**: Basado en el perfil del usuario y las preguntas que realicen, la IA recomendará las mejores inversiones.
4. **Inversiones Automáticas**: Configura inversiones automáticas basadas en estrategias personalizadas.

## 📦 API Endpoints

- `POST /api/generate-text`: Utiliza la IA para responder preguntas sobre inversiones.
- `GET /api/investments`: Lista todas las oportunidades de inversión disponibles.

## 📄 Ejemplo de Archivo `.env`

```env
APP_NAME=MicroinversionesIA
APP_ENV=local
APP_KEY=base64:clave_generada_por_key_generate
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=microinversiones
DB_USERNAME=root
DB_PASSWORD=password

OPENAI_API_KEY=tu_clave_de_openai
```

## 🔮 Futuras Mejoras

- **Soporte para múltiples idiomas** 🌍.
- **Implementación de una app móvil** 📱.
- **Sistema de notificaciones en tiempo real** 🔔.
- **Integración de más APIs para análisis financiero** 📊.

## 👥 Contribuciones

¡Las contribuciones son bienvenidas! Si quieres contribuir, por favor sigue los siguientes pasos:

1. Haz un fork del proyecto 🍴.
2. Crea una nueva rama (`git checkout -b feature/nueva-feature`) 🌱.
3. Realiza tus cambios y haz un commit (`git commit -m 'Añadir nueva feature'`) 📝.
4. Haz un push a la rama (`git push origin feature/nueva-feature`) 🚢.
5. Abre un Pull Request 🚀.

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

## ✨ Agradecimientos

Queremos agradecer a todas las herramientas de código abierto y a las plataformas que nos han permitido hacer realidad este proyecto. Agradecimientos especiales a:

- **Laravel** y su comunidad 🙌.
- **OpenAI** por la API de ChatGPT 🤖.
- **Heroku** por proporcionar un entorno de despliegue sencillo ☁️.

---

¡Esperamos que disfrutes usando la plataforma y que te ayude a invertir de manera más inteligente! 💡📈

Para más información, siéntete libre de contactar con nosotros o abrir un issue en el repositorio.

