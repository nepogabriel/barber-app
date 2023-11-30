# Comandos Laravel:
Form Request (Para validações)
- php artisan make:request <NomeFormRequest>

# Criar o Controller: 
- php artisan make:controller NomeController

# Status da migration:
- php artisan migrate:status

# Criar tabelas bases do lavavel: 
- php artisan migrate

# Criar tabela especifica laravel:
- php atisan make:migration create_products_table

# Adicionando coluna na tabela:
- php artisan make:migration add_category_to_products_table

# Deleta e migra todas as tabelas novamente:
- php artisan migrate:fresh

#Rollback migrate:
- php artisan migrate:rollback

# Refresh migrate (faz o rollback e o migrate em um comando):
- php artisan migrate:refresh

# Criando model:
- php artisan make:model Event

# Gerando key p/ clone projeto laravel:
- php artisan key:generate