USE [um_db]
GO

SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

ALTER PROCEDURE [dbo].[USP_TampilInputListhutang]
    @tahun INT
AS
BEGIN
    -- Drop temporary table #temptess if exists
    IF EXISTS (SELECT [name] 
               FROM tempdb..sysobjects 
               WHERE [name] LIKE '#temptess%')
    BEGIN
        DROP TABLE #temptess
    END

    -- Drop temporary table #temptess2 if exists
    IF EXISTS (SELECT [name] 
               FROM tempdb..sysobjects 
               WHERE [name] LIKE '#temptess2%')
    BEGIN
        DROP TABLE #temptess2
    END

    -- Create temporary table #temptess
    CREATE TABLE #temptess (
        nama_bulan     VARCHAR(100),
        bulan          INT,
        tahun          INT,
        Currency       VARCHAR(10),
        Amount_Input   FLOAT,
        Kurs           FLOAT,
        Amount         FLOAT
    )

    -- Create temporary table #temptess2 (belum digunakan)
    CREATE TABLE #temptess2 (
        amount         FLOAT,
        nama_bulan     VARCHAR(100),
        bulan          INT,
        tahun          INT
    )

    -- Insert data ke #temptess
    INSERT INTO #temptess
    SELECT  
        a.nama_bulan,
        a.bulan,
        a.tahun,
        b.Currency,
        b.Amount_Input,
        b.Kurs,
        CASE 
            WHEN b.Currency = 'Rp' OR b.Kurs IS NULL THEN b.Amount_Input 
            ELSE b.Amount_Input * b.Kurs 
        END
    FROM 
        [um_db].[dbo].[thn_bln_gl] AS a
    LEFT JOIN  
        [um_db].[dbo].[Listhutang] AS b
        ON YEAR(b.tanggal_invoice) = a.tahun 
        AND MONTH(b.tanggal_invoice) = a.bulan
    WHERE 
        a.tahun = @tahun

    -- Tampilkan hasil akhir
    INSERT INTO #temptess2
    SELECT 
        ISNULL((
            SELECT SUM(b.Amount)
            FROM #temptess AS b
            WHERE b.tahun = @tahun AND b.bulan = a.bulan
        ), 0) AS amount,
        a.nama_bulan,
        a.bulan,
        a.tahun
    FROM 
        [um_db].[dbo].[thn_bln_gl] AS a
    WHERE 
        a.tahun = @tahun

SELECT  * FROM #temptess2
END
GO

-- Eksekusi prosedur
EXEC USP_TampilInputListhutang 2025
