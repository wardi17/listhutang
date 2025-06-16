USE [um_db]
GO
/****** Object:  StoredProcedure [dbo].[USP_TampilInputListhutang]    Script Date: 05/24/2024 08:10:53 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[USP_TampilInputListhutang]
@tahun int
AS
	IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess') 
    BEGIN
      DROP TABLE #temptess;
    END;

  	IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess2') 
    BEGIN
      DROP TABLE #temptess2;
    END;
  create table #temptess(
	  amount_input FLOAT,
	  nama_bulan VARCHAR(100),
	  bulan int,
	  tahun int
	);  
    
 create table #temptess2(
	  amount FLOAT,
	  nama_bulan VARCHAR(100),
	  bulan int,
	  tahun int
	);  
BEGIN
	BEGIN
	INSERT INTO #temptess
   SELECT ((SELECT COALESCE( (SELECT sum(b.amount_Input) FROM [um_db].[dbo].[Listhutang] 
   AS b where  YEAR(b.tanggal_invoice)=@tahun AND MONTH(b.tanggal_invoice) =a.bulan), 0))) as  amount_input,
   a.nama_bulan,a.bulan,a.tahun
    FROM [um_db].[dbo].thn_bln_gl  as a WHERE a.tahun=@tahun
   END
   BEGIN
    INSERT INTO #temptess2
    SELECT (amount_input) as amount,nama_bulan,bulan,tahun FROM #temptess	
   END
   
   SELECT * FROM #temptess2
END

GO
EXEC USP_TampilInputListhutang '2025'


 