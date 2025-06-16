USE [um_db]
GO

CREATE TABLE thn_bln_gl(
    bulan int,
    nama_bulan VARCHAR(100),
    tahun int
);

DROP TABLE Listhutang
CREATE TABLE Listhutang(
    Id_Trans VARCHAR(100) NOT NULL,
    noinvoice VARCHAR(100) NOT NULL,
    tanggal_invoice DATETIME,
    tanggal_jatuhtempo DATETIME,
    Amount_Input FLOAT DEFAULT 0,
    Kelompok VARCHAR(200) NOT NULL,
    recan_bayar DATETIME,
    Keterangan VARCHAR(200),
    Catatan_Input VARCHAR(5000),
    date_Input DATETIME DEFAULT  GETDATE(),
    date_edit DATETIME,
    date_bayar DATETIME,
    User_Input VARCHAR(50),
    User_Edit VARCHAR(50),
    StatusAP CHAR(1) DEFAULT 'N',
    last_update_AP DATETIME,
    StatusCR CHAR(1) DEFAULT 'N',
    last_update_CR DATETIME,
    Tgl_bayar DATETIME,
    Currency VARCHAR(10) NULL,
    Kurs FLOAT DEFAULT 0,
    CustomerID CHAR(10) NULL,
     PRIMARY KEY(Id_Trans)
);


ALTER TABLE Listhutang
ADD  CustomerID CHAR(10) NULL;
 
--untuk alert nama kolom
EXEC sp_rename 'Listhutang.CustomerID', 'SupplierID', 'COLUMN';


CREATE TABLE Bulan_gl(
    tanggal int,
    bulan int,
    tahun int
)