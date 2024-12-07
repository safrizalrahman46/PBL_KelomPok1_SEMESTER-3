USE [master]
GO
/****** Object:  Database [tatib]    Script Date: 12/7/2024 10:55:53 AM ******/
CREATE DATABASE [tatib]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'tatib', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\tatib.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'tatib_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\tatib_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
GO
ALTER DATABASE [tatib] SET COMPATIBILITY_LEVEL = 140
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [tatib].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [tatib] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [tatib] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [tatib] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [tatib] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [tatib] SET ARITHABORT OFF 
GO
ALTER DATABASE [tatib] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [tatib] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [tatib] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [tatib] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [tatib] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [tatib] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [tatib] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [tatib] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [tatib] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [tatib] SET  ENABLE_BROKER 
GO
ALTER DATABASE [tatib] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [tatib] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [tatib] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [tatib] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [tatib] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [tatib] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [tatib] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [tatib] SET RECOVERY FULL 
GO
ALTER DATABASE [tatib] SET  MULTI_USER 
GO
ALTER DATABASE [tatib] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [tatib] SET DB_CHAINING OFF 
GO
ALTER DATABASE [tatib] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [tatib] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [tatib] SET DELAYED_DURABILITY = DISABLED 
GO
EXEC sys.sp_db_vardecimal_storage_format N'tatib', N'ON'
GO
ALTER DATABASE [tatib] SET QUERY_STORE = OFF
GO
USE [tatib]
GO
/****** Object:  Table [dbo].[tb_admin]    Script Date: 12/7/2024 10:55:53 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_admin](
	[id_admin] [int] IDENTITY(1,1) NOT NULL,
	[email_admin] [nvarchar](100) NULL,
	[id_users] [int] NULL,
	[nama] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_admin] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_dosen]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_dosen](
	[nip] [int] IDENTITY(1,1) NOT NULL,
	[email] [nvarchar](255) NULL,
	[id_users] [int] NULL,
	[nama] [varchar](255) NULL,
	[alamat] [varchar](255) NULL,
	[no_telepon] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[nip] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_jenis_pelanggaran]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_jenis_pelanggaran](
	[id_jenis_pelanggaran] [int] IDENTITY(1,1) NOT NULL,
	[deskripsi] [nvarchar](255) NULL,
	[id_tingkat] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id_jenis_pelanggaran] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_kelas]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_kelas](
	[id_kelas] [int] IDENTITY(1,1) NOT NULL,
	[nama_kelas] [varchar](20) NOT NULL,
	[nama_dpa] [varchar](20) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_kelas] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_laporpelanggaranmahasiswa]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_laporpelanggaranmahasiswa](
	[id_pelanggaran] [int] IDENTITY(1,1) NOT NULL,
	[mahasiswa_id] [int] NOT NULL,
	[id_jenis_pelanggaran] [int] NOT NULL,
	[status] [nvarchar](50) NULL,
	[komentar] [nvarchar](max) NULL,
	[id_admin] [int] NULL,
	[id_dosen] [int] NULL,
	[status_verifikasi_admin] [nvarchar](5) NULL,
	[nim] [nvarchar](10) NULL,
	[foto] [nvarchar](30) NULL,
	[tanggal_laporan] [date] NULL,
	[nama] [varchar](20) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_pelanggaran] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_log]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_log](
	[id_log] [int] IDENTITY(1,1) NOT NULL,
	[admin_id] [int] NOT NULL,
	[deskripsi_tugas] [nvarchar](max) NOT NULL,
	[tanggal_tugas] [date] NULL,
PRIMARY KEY CLUSTERED 
(
	[id_log] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_mahasiswa]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_mahasiswa](
	[NIM] [int] IDENTITY(1,1) NOT NULL,
	[email] [nvarchar](255) NULL,
	[semester] [int] NOT NULL,
	[tingkat] [int] NOT NULL,
	[foto] [nvarchar](255) NULL,
	[status] [nvarchar](15) NOT NULL,
	[id_pelanggaran] [int] NULL,
	[id_prodi] [int] NULL,
	[id_kelas] [int] NULL,
	[id_users] [int] NULL,
	[nama] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[NIM] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_notifikasi]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_notifikasi](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_penerima] [int] NULL,
	[pesan] [nvarchar](15) NULL,
	[tanggal_kirim] [date] NULL,
	[id_pelanggaran] [int] NULL,
	[id_tipe_notifikasi] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_prodi]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_prodi](
	[id_prodi] [int] IDENTITY(1,1) NOT NULL,
	[nama_prodi] [nvarchar](100) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_prodi] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_tingkat_pelanggaran]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_tingkat_pelanggaran](
	[id_tingkat_pelanggaran] [int] IDENTITY(1,1) NOT NULL,
	[nama_tingkat] [nvarchar](50) NULL,
	[deskripsi] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_tingkat_pelanggaran] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_tipe_notifikasi]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_tipe_notifikasi](
	[id_tipe_notifikasi] [int] IDENTITY(1,1) NOT NULL,
	[notif_template] [nvarchar](255) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_tipe_notifikasi] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_users]    Script Date: 12/7/2024 10:55:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_users](
	[id_users] [int] IDENTITY(1,1) NOT NULL,
	[username] [nvarchar](255) NOT NULL,
	[password] [nvarchar](255) NOT NULL,
	[level] [nvarchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_users] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[tb_laporpelanggaranmahasiswa] ADD  DEFAULT ('Pending') FOR [status]
GO
ALTER TABLE [dbo].[tb_mahasiswa] ADD  DEFAULT ('Aktif') FOR [status]
GO
ALTER TABLE [dbo].[tb_admin]  WITH CHECK ADD  CONSTRAINT [FK_admin_users] FOREIGN KEY([id_users])
REFERENCES [dbo].[tb_users] ([id_users])
GO
ALTER TABLE [dbo].[tb_admin] CHECK CONSTRAINT [FK_admin_users]
GO
ALTER TABLE [dbo].[tb_dosen]  WITH CHECK ADD  CONSTRAINT [FK_dosen_users] FOREIGN KEY([id_users])
REFERENCES [dbo].[tb_users] ([id_users])
GO
ALTER TABLE [dbo].[tb_dosen] CHECK CONSTRAINT [FK_dosen_users]
GO
ALTER TABLE [dbo].[tb_jenis_pelanggaran]  WITH CHECK ADD  CONSTRAINT [FK_jenis_pelanggaran_tingkat] FOREIGN KEY([id_tingkat])
REFERENCES [dbo].[tb_tingkat_pelanggaran] ([id_tingkat_pelanggaran])
GO
ALTER TABLE [dbo].[tb_jenis_pelanggaran] CHECK CONSTRAINT [FK_jenis_pelanggaran_tingkat]
GO
ALTER TABLE [dbo].[tb_laporpelanggaranmahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_lapor_pelanggaran_jenis] FOREIGN KEY([id_jenis_pelanggaran])
REFERENCES [dbo].[tb_jenis_pelanggaran] ([id_jenis_pelanggaran])
GO
ALTER TABLE [dbo].[tb_laporpelanggaranmahasiswa] CHECK CONSTRAINT [FK_lapor_pelanggaran_jenis]
GO
ALTER TABLE [dbo].[tb_laporpelanggaranmahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_lapor_pelanggaran_mahasiswa] FOREIGN KEY([mahasiswa_id])
REFERENCES [dbo].[tb_mahasiswa] ([NIM])
GO
ALTER TABLE [dbo].[tb_laporpelanggaranmahasiswa] CHECK CONSTRAINT [FK_lapor_pelanggaran_mahasiswa]
GO
ALTER TABLE [dbo].[tb_laporpelanggaranmahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_pelanggaran_mahasiswa_admin] FOREIGN KEY([id_admin])
REFERENCES [dbo].[tb_admin] ([id_admin])
GO
ALTER TABLE [dbo].[tb_laporpelanggaranmahasiswa] CHECK CONSTRAINT [FK_pelanggaran_mahasiswa_admin]
GO
ALTER TABLE [dbo].[tb_laporpelanggaranmahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_pelanggaran_mahasiswa_dosen] FOREIGN KEY([id_dosen])
REFERENCES [dbo].[tb_dosen] ([nip])
GO
ALTER TABLE [dbo].[tb_laporpelanggaranmahasiswa] CHECK CONSTRAINT [FK_pelanggaran_mahasiswa_dosen]
GO
ALTER TABLE [dbo].[tb_log]  WITH CHECK ADD  CONSTRAINT [FK_log_admin] FOREIGN KEY([admin_id])
REFERENCES [dbo].[tb_admin] ([id_admin])
GO
ALTER TABLE [dbo].[tb_log] CHECK CONSTRAINT [FK_log_admin]
GO
ALTER TABLE [dbo].[tb_mahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_mahasiswa_kelas] FOREIGN KEY([id_kelas])
REFERENCES [dbo].[tb_kelas] ([id_kelas])
GO
ALTER TABLE [dbo].[tb_mahasiswa] CHECK CONSTRAINT [FK_mahasiswa_kelas]
GO
ALTER TABLE [dbo].[tb_mahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_mahasiswa_prodi] FOREIGN KEY([id_prodi])
REFERENCES [dbo].[tb_prodi] ([id_prodi])
GO
ALTER TABLE [dbo].[tb_mahasiswa] CHECK CONSTRAINT [FK_mahasiswa_prodi]
GO
ALTER TABLE [dbo].[tb_mahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_mahasiswa_users] FOREIGN KEY([id_users])
REFERENCES [dbo].[tb_users] ([id_users])
GO
ALTER TABLE [dbo].[tb_mahasiswa] CHECK CONSTRAINT [FK_mahasiswa_users]
GO
ALTER TABLE [dbo].[tb_notifikasi]  WITH CHECK ADD  CONSTRAINT [FK_notifikasi_tipe_notifikasi] FOREIGN KEY([id_tipe_notifikasi])
REFERENCES [dbo].[tb_tipe_notifikasi] ([id_tipe_notifikasi])
GO
ALTER TABLE [dbo].[tb_notifikasi] CHECK CONSTRAINT [FK_notifikasi_tipe_notifikasi]
GO
USE [master]
GO
ALTER DATABASE [tatib] SET  READ_WRITE 
GO
