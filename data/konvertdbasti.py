import pandas as pd
import mysql.connector

# Buat koneksi ke database
conn = mysql.connector.connect(
    host='localhost',        # Ganti dengan host Anda
    user='root',         # Ganti dengan username Anda
    password='mysqlwilly',     # Ganti dengan password Anda
    database='asti_dbv3' # Ganti dengan nama database Anda
)

# Buat query SQL
query = "SELECT * FROM pegawai"  # Ganti dengan nama tabel Anda

# Ambil data ke dalam DataFrame
df = pd.read_sql(query, conn)

# Tampilkan DataFrame
print(df)

# Tutup koneksi
conn.close()