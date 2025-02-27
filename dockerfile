# Gunakan base image untuk Python 2.12
FROM python:3.12-slim

# Set environment variable untuk memastikan Python tidak menulis bytecode .pyc
ENV PYTHONUNBUFFERED 1

# Install dependencies untuk Python
RUN pip install --no-cache-dir flask flask-cors pymysql requests

# Set working directory untuk aplikasi Python
WORKDIR /app

# Copy seluruh kode aplikasi Python ke dalam container
COPY . /app

# Expose port untuk Flask (default 5000)
EXPOSE 5000

# Menjalankan aplikasi Flask menggunakan Python
CMD ["python3", "astar.py"]
