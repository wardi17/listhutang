USE [um_db]
GO
/****** Object:  StoredProcedure [dbo].[USP_SimpanBulanListhutang]    Script Date: 05/24/2024 08:10:53 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[USP_SimpanBulanListhutang]
@tahun int,
@nama_bulan VARCHAR(100),
@bulan int
AS
BEGIN
    IF NOT EXISTS(SELECT * FROM [um_db].[dbo].thn_bln_gl WHERE tahun=@tahun AND nama_bulan=@nama_bulan AND bulan =@bulan)
    BEGIN
    	INSERT INTO [um_db].[dbo].thn_bln_gl(bulan,nama_bulan,tahun)VALUES(@bulan,@nama_bulan,@tahun)
    END

END

GO
EXEC USP_SimpanBulanListhutang '2024','Januari','1'


