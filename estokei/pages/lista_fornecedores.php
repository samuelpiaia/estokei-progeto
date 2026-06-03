<?php 
    include("config/config.php");

    $sql = "SELECT * FROM fornecedores ORDER BY id DESC";
    $consulta = $pdo->query($sql);
    
    // CORREÇÃO: Usar fetchAll() para retornar todos os fornecedores
    $fornecedores = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Cabeçalho da Página de Fornecedores -->
<div class="mb-8 flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4">
    <div>
        <h2 class="text-2xl sm:text-3xl font-bold text-white mb-1">Fornecedores</h2>
        <p class="text-estokei-textMuted text-sm">Gerencie os parceiros e empresas que abastecem o seu estoque.</p>
    </div>
    <button class="flex items-center justify-center gap-2 bg-estokei-accent hover:bg-estokei-accentHover text-estokei-bg font-bold py-2 px-5 rounded-full transition-all shadow-neon hover:shadow-neon-strong transform hover:-translate-y-0.5">
        <i class="ph ph-truck text-lg"></i>
        <span>Novo Fornecedor</span>
    </button>
</div>

<!-- Tabela Container Padronizada -->
<div class="bg-estokei-panel rounded-2xl border border-white/5 overflow-hidden">
    
    <!-- Barra superior da Tabela (Busca) -->
    <div class="p-6 border-b border-white/5 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <h3 class="text-lg font-bold text-white">Lista de Fornecedores</h3>
        <div class="relative w-full sm:w-80">
            <i class="ph ph-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-estokei-textMuted"></i>
            <input type="text" placeholder="Pesquisar por nome ou contato..." class="bg-estokei-bg border border-white/10 rounded-lg py-2 pl-9 pr-4 text-sm focus:outline-none focus:border-estokei-accent focus:ring-1 focus:ring-estokei-accent transition-all placeholder-estokei-textMuted text-white w-full">
        </div>
    </div>

    <!-- Tabela Responsiva -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[600px]">
            <thead>
                <tr class="bg-white/5 text-estokei-textMuted text-xs uppercase tracking-wider">
                    <th class="p-4 font-semibold w-20">ID</th>
                    <th class="p-4 font-semibold">Nome da Empresa</th>
                    <th class="p-4 font-semibold">Informações de Contato</th>
                    <th class="p-4 font-semibold text-center w-24">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 text-sm">
                
                <?php if (count($fornecedores) > 0): ?>
                    <?php foreach($fornecedores as $fornecedor): ?>
                        <tr class="hover:bg-white/5 transition-colors group">
                            
                            <!-- ID -->
                            <td class="p-4 text-estokei-textMuted font-medium">
                                #<?php echo str_pad($fornecedor['id'], 4, '0', STR_PAD_LEFT); ?>
                            </td>
                            
                            <!-- Nome com Ícone -->
                            <td class="p-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center border border-white/10 shrink-0">
                                    <i class="ph ph-buildings text-xl text-gray-300"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-white"><?php echo htmlspecialchars($fornecedor['nome']); ?></p>
                                    <p class="text-xs text-estokei-textMuted">Fornecedor Ativo</p>
                                </div>
                            </td>
                            
                            <!-- Contato -->
                            <td class="p-4">
                                <div class="flex items-center gap-2 text-estokei-textMuted">
                                    <i class="ph ph-address-book text-lg"></i>
                                    <span><?php echo htmlspecialchars($fornecedor['contato']); ?></span>
                                </div>
                            </td>
                            
                            <!-- Ações -->
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <!-- Botão Editar -->
                                    <button onclick="location.href='index.php?page=atualizar_fornecedor.php&id=<?php echo $fornecedor['id'] ?>'" class="p-2 rounded-lg text-estokei-textMuted hover:text-estokei-accent hover:bg-estokei-accent/10 transition-colors" title="Editar Fornecedor" >
                                        <i class="ph ph-pencil-simple text-lg"></i>
                                    </button>
                                    
                                    <!-- Botão Excluir -->
                                    <button onclick="location.href='api/delete.php?table=fornecedores&id=<?php echo $fornecedor['id']; ?>'" class="p-2 rounded-lg text-estokei-textMuted hover:text-estokei-danger hover:bg-estokei-danger/10 transition-colors" title="Excluir Fornecedor" onclick="return confirm('Tem certeza que deseja excluir o fornecedor <?php echo htmlspecialchars($fornecedor['nome']); ?>?');">
                                        <i class="ph ph-trash text-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="p-8 text-center text-estokei-textMuted">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i class="ph ph-truck text-4xl mb-2 opacity-50"></i>
                                <p>Nenhum fornecedor cadastrado no sistema.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                
            </tbody>
        </table>
    </div>
</div>
