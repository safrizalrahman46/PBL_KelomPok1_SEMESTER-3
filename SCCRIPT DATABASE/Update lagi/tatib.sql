USE [tatib]
GO
/****** Object:  Table [dbo].[admin]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[admin](
	[id_admin] [int] IDENTITY(1,1) NOT NULL,
	[nama_admin] [nvarchar](100) NOT NULL,
	[email_admin] [nvarchar](100) NULL,
	[password_admin] [nvarchar](255) NOT NULL,
	[id_kelas] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id_admin] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[admin_task_log]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[admin_task_log](
	[id_log] [int] IDENTITY(1,1) NOT NULL,
	[admin_id] [int] NOT NULL,
	[task_description] [nvarchar](max) NOT NULL,
	[task_date] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_log] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[department]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[department](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](255) NULL,
	[fakultas_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[dosen]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[dosen](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](255) NULL,
	[department_id] [int] NULL,
	[email] [nvarchar](255) NULL,
	[NIP] [bigint] NULL,
	[username] [nvarchar](255) NULL,
	[password] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[dpa]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[dpa](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nama] [nvarchar](100) NOT NULL,
	[program_studi] [nvarchar](100) NULL,
	[nomor_telepon] [nvarchar](15) NULL,
	[email] [nvarchar](100) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[fakultas]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[fakultas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[jurusan]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[jurusan](
	[id_jurusan] [int] IDENTITY(1,1) NOT NULL,
	[nama_jurusan] [nvarchar](100) NOT NULL,
	[department_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id_jurusan] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[kelas]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[kelas](
	[id_kelas] [int] IDENTITY(1,1) NOT NULL,
	[nama_kelas] [nvarchar](100) NOT NULL,
	[tingkat] [int] NOT NULL,
	[jurusan] [nvarchar](50) NULL,
	[prodi] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_kelas] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[komisi_discipline_decision]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[komisi_discipline_decision](
	[id_decision] [int] IDENTITY(1,1) NOT NULL,
	[pelanggaran_id] [int] NOT NULL,
	[decision] [nvarchar](255) NOT NULL,
	[decision_date] [datetime2](7) NULL,
	[sanction_type] [nvarchar](100) NULL,
	[remarks] [nvarchar](max) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_decision] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[komite_disiplin_mahasiswa]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[komite_disiplin_mahasiswa](
	[id_komite] [int] IDENTITY(1,1) NOT NULL,
	[nama_komite] [nvarchar](100) NOT NULL,
	[kontak_komite] [nvarchar](100) NULL,
	[role] [nvarchar](100) NULL,
	[jurisdiction] [nvarchar](100) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_komite] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[kps]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[kps](
	[id_kps] [int] IDENTITY(1,1) NOT NULL,
	[nama_kps] [nvarchar](100) NOT NULL,
	[department_id] [int] NULL,
	[email] [nvarchar](100) NULL,
	[NIP] [bigint] NULL,
PRIMARY KEY CLUSTERED 
(
	[id_kps] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[mahasiswa]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[mahasiswa](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](255) NULL,
	[department_id] [int] NULL,
	[email] [nvarchar](255) NULL,
	[NIM] [nvarchar](20) NOT NULL,
	[username] [nvarchar](255) NULL,
	[password] [nvarchar](255) NULL,
	[total_violation_points] [int] NULL,
	[total_reward_points] [int] NULL,
	[semester] [int] NOT NULL,
	[tingkat] [int] NOT NULL,
	[foto] [nvarchar](255) NULL,
	[status] [nvarchar](15) NOT NULL,
	[jurusan] [nvarchar](255) NULL,
	[prodi] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[notification]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[notification](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[recipient_id] [int] NULL,
	[message] [nvarchar](255) NULL,
	[date_sent] [datetime2](7) NULL,
	[acknowledged] [bit] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[pelanggaran_mahasiswa]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[pelanggaran_mahasiswa](
	[id_pelanggaran] [int] IDENTITY(1,1) NOT NULL,
	[mahasiswa_id] [int] NOT NULL,
	[violation_type_id] [int] NOT NULL,
	[reported_by] [int] NOT NULL,
	[dpa_verification_status] [bit] NULL,
	[report_date] [datetime2](7) NULL,
	[sanction_status] [nvarchar](50) NULL,
	[sanction_start_date] [date] NULL,
	[sanction_end_date] [date] NULL,
	[comments] [nvarchar](max) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_pelanggaran] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[pelapor]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[pelapor](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nama] [nvarchar](100) NOT NULL,
	[nomor_telepon] [nvarchar](15) NULL,
	[email] [nvarchar](100) NULL,
	[alamat] [nvarchar](max) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[prodi]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[prodi](
	[id_prodi] [int] IDENTITY(1,1) NOT NULL,
	[nama_prodi] [nvarchar](100) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id_prodi] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[reward_archive]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[reward_archive](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[mahasiswa_id] [int] NULL,
	[total_reward_points] [int] NULL,
	[rewards_issued] [nvarchar](255) NULL,
	[recognition_date] [datetime2](7) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[reward_points]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[reward_points](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[mahasiswa_id] [int] NULL,
	[points_earned] [int] NULL,
	[date_awarded] [datetime2](7) NULL,
	[reward_type] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tenaga_kependidikan]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tenaga_kependidikan](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](255) NULL,
	[department_id] [int] NULL,
	[email] [nvarchar](255) NULL,
	[username] [nvarchar](255) NULL,
	[password] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[user_id] [int] IDENTITY(1,1) NOT NULL,
	[nama] [nvarchar](255) NOT NULL,
	[username] [nvarchar](255) NOT NULL,
	[password] [nvarchar](255) NOT NULL,
	[level] [nvarchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[violation_level]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[violation_level](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[level_name] [nvarchar](50) NULL,
	[description] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[violation_report]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[violation_report](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[submitted_by] [int] NULL,
	[violation_type] [int] NULL,
	[report_date] [datetime2](7) NULL,
	[status] [nvarchar](255) NULL,
	[reviewed_by] [int] NULL,
	[resolution_date] [datetime2](7) NULL,
	[comments] [nvarchar](255) NULL,
	[dpa_verification_status] [bit] NULL,
	[faculty_involved_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[violation_type]    Script Date: 12/4/2024 2:41:07 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[violation_type](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[description] [nvarchar](255) NULL,
	[level_id] [int] NULL,
	[penalty_points] [int] NULL,
	[sanction] [nvarchar](max) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
ALTER TABLE [dbo].[komisi_discipline_decision] ADD  DEFAULT (getdate()) FOR [decision_date]
GO
ALTER TABLE [dbo].[mahasiswa] ADD  DEFAULT ((0)) FOR [total_violation_points]
GO
ALTER TABLE [dbo].[mahasiswa] ADD  DEFAULT ((0)) FOR [total_reward_points]
GO
ALTER TABLE [dbo].[mahasiswa] ADD  DEFAULT ('Aktif') FOR [status]
GO
ALTER TABLE [dbo].[notification] ADD  DEFAULT (getdate()) FOR [date_sent]
GO
ALTER TABLE [dbo].[notification] ADD  DEFAULT ((0)) FOR [acknowledged]
GO
ALTER TABLE [dbo].[pelanggaran_mahasiswa] ADD  DEFAULT ((0)) FOR [dpa_verification_status]
GO
ALTER TABLE [dbo].[pelanggaran_mahasiswa] ADD  DEFAULT (getdate()) FOR [report_date]
GO
ALTER TABLE [dbo].[pelanggaran_mahasiswa] ADD  DEFAULT ('Pending') FOR [sanction_status]
GO
ALTER TABLE [dbo].[reward_archive] ADD  DEFAULT (getdate()) FOR [recognition_date]
GO
ALTER TABLE [dbo].[reward_points] ADD  DEFAULT (getdate()) FOR [date_awarded]
GO
ALTER TABLE [dbo].[violation_report] ADD  DEFAULT (getdate()) FOR [report_date]
GO
ALTER TABLE [dbo].[violation_report] ADD  DEFAULT ((0)) FOR [dpa_verification_status]
GO
ALTER TABLE [dbo].[jurusan]  WITH CHECK ADD  CONSTRAINT [FK_jurusan_department] FOREIGN KEY([department_id])
REFERENCES [dbo].[department] ([id])
GO
ALTER TABLE [dbo].[jurusan] CHECK CONSTRAINT [FK_jurusan_department]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD CHECK  (([level]='operator' OR [level]='admin' OR [level]='bk' OR [level]='komite disiplin' OR [level]='tendik' OR [level]='mahasiswa' OR [level]='kps' OR [level]='dpa' OR [level]='dosen'))
GO
