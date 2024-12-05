ALTER TABLE [dbo].[tb_dosen]
ADD CONSTRAINT FK_dosen_users
FOREIGN KEY ([id_users]) REFERENCES [dbo].[tb_users] ([id_users]);