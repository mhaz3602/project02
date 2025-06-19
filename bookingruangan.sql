-- ==================================================
--  APLIKASI BOOKING RUANG KELAS
-- ==================================================

-- Buat Database
CREATE DATABASE IF NOT EXISTS booking_ruangan;
USE booking_ruangan;

-- Tabel Mahasiswa
CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  NIM VARCHAR(15) NOT NULL UNIQUE,
  jurusan VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Ruangan
CREATE TABLE ruangan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  kapasitas INT NOT NULL,
  lokasi VARCHAR(100) NOT NULL,
  fasilitas VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Booking
CREATE TABLE booking (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_mahasiswa INT NOT NULL,
  id_ruangan INT NOT NULL,
  tanggal DATE NOT NULL,
  jam_mulai TIME NOT NULL,
  jam_selesai TIME NOT NULL,
  keperluan VARCHAR(100) NOT NULL,
  status ENUM('disetujui','dibatalkan','selesai','pending') DEFAULT 'disetujui',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_mahasiswa) REFERENCES mahasiswa(id) ON DELETE CASCADE,
  FOREIGN KEY (id_ruangan) REFERENCES ruangan(id) ON DELETE CASCADE
);

-- Contoh Mahasiswa
INSERT INTO mahasiswa (nama, NIM, jurusan, email, password) VALUES
('Ali', '12345678', 'Informatika', 'ali@example.com', MD5('123456')),
('Budi', '87654321', 'Sistem Informasi', 'budi@example.com', MD5('123456'));

-- Contoh Ruangan
INSERT INTO ruangan (nama, kapasitas, lokasi, fasilitas) VALUES
('Ruang A', 10, 'Gedung A Lantai 1', 'AC, Proyektor, Whiteboard'),
('Ruang B', 15, 'Gedung A Lantai 2', 'AC, TV'),
('Ruang Lab 1', 20, 'Gedung C Lantai 3', 'Kabel HDMI, AC, Proyektor');

-- Contoh Booking
INSERT INTO booking (id_mahasiswa, id_ruangan, tanggal, jam_mulai, jam_selesai, keperluan, status) VALUES
(1, 1, '2025-06-20', '08:00:00', '10:00:00', 'Rapat Kelompok', 'disetujui'),
(2, 2, '2025-06-21', '09:00:00', '11:30:00', 'Belajar Bareng', 'pending');