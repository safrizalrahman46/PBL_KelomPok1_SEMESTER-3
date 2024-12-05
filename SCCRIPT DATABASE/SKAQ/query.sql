ALTER TABLE [dbo].[tb_mahasiswa]
ADD CONSTRAINT FK_mahasiswa_users
FOREIGN KEY ([id_users]) REFERENCES [dbo].[tb_users] ([id_users]);