INSERT INTO permissions (title,permission,created_at,updated_at) VALUES
('Admin Dashboard','admin.index',NOW(),NOW())
,('Cadastrar Encomenda','admin.orders.create',NOW(),NOW())
,('Excluir Encomenda','admin.orders.destroy',NOW(),NOW())
,('Editar Encomenda','admin.orders.edit',NOW(),NOW())
,('Listar Encomendas','admin.orders.index',NOW(),NOW())
,('Detalhes Encomenda','admin.orders.show',NOW(),NOW())
,('Cadastrar Residência','admin.residences.create',NOW(),NOW())
,('Excluir Residência','admin.residences.destroy',NOW(),NOW())
,('Listar Residências','admin.residences.index',NOW(),NOW())
,('Detalhes Residência','admin.residences.show',NOW(),NOW())
,('Editar Residência','admin.residences.edit',NOW(),NOW())
,('Listar Ruas','admin.streets.index',NOW(),NOW())
,('Cadastrar Rua','admin.streets.create',NOW(),NOW())
,('Excluir Rua','admin.streets.destroy',NOW(),NOW())
,('Detalhes Rua','admin.streets.show',NOW(),NOW())
,('Editar Rua','admin.streets.edit',NOW(),NOW())
,('Listar Grupos de Acesso','admin.userAccessGroups.index',NOW(),NOW())
,('Criar Grupo de Acesso','admin.userAccessGroups.create',NOW(),NOW())
,('Detalhes Grupo de Acesso','admin.userAccessGroups.show',NOW(),NOW())
,('Excluir Grupo de Acesso','admin.userAccessGroups.destroy',NOW(),NOW())
,('Editar Grupo de Acesso','admin.userAccessGroups.edit',NOW(),NOW())
,('Listar Usuários','admin.users.index',NOW(),NOW())
,('Criar Usuário','admin.users.create',NOW(),NOW())
,('Remover Foto Usuário','admin.users.remove.photo',NOW(),NOW())
,('Detalhes Usuário','admin.users.show',NOW(),NOW())
,('Excluir Usuário','admin.users.destroy',NOW(),NOW())
,('Editar Usuário','admin.users.edit',NOW(),NOW())
,('Listar Grupos de Usuários','admin.groups.index',NOW(),NOW())
,('Criar Grupo de Usuários','admin.groups.create',NOW(),NOW())
,('Editar Grupo de Usuários','admin.groups.edit',NOW(),NOW())
,('Excluir Grupo de Usuários','admin.groups.destroy',NOW(),NOW())
,('Listar Circulares','admin.circulars.index',NOW(),NOW())
,('Criar Circular','admin.circulars.create',NOW(),NOW())
,('Editar Circular','admin.circulars.edit',NOW(),NOW())
,('Excluir Circular','admin.circulars.destroy',NOW(),NOW())
;
