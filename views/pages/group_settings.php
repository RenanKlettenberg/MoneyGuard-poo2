<?php
require_once '../views/components/header.php';

$currentTheme = $_SESSION['user_theme'] ?? 'dark';

if (!in_array($currentTheme, ['dark', 'light'], true)) {
    $currentTheme = 'dark';
}

?>
<style>
    .config-container {
        max-width: 100%;
        margin: 0 auto;
        padding-bottom: 80px;
    }

    .config-title {
        font-size: 1.5rem;
        color: var(--color-text);
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .settings-card {
        background: var(--color-background-panel);
        border: 1px solid var(--color-border-soft);
        border-radius: 20px;
        padding: 40px;
        box-shadow: var(--shadow-panel);
        margin-bottom: 24px;
    }

    .section-label {
        color: var(--color-text);
        font-size: 1.1rem;
        margin-bottom: 1rem;
        display: block;
    }

    .input-label {
        color: var(--color-text-secondary);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .custom-input {
        width: 100%;
        background-color: var(--color-background);
        border: 1px solid var(--color-border);
        color: var(--color-text);
        padding: 12px 20px;
        border-radius: 50px; 
        font-size: 1rem;
        outline: none;
        transition: border-color 0.3s;
    }

    .custom-input:focus {
        border-color: var(--color-primary);
    }

    .custom-input[readonly] {
        color: var(--color-text-secondary);
        cursor: default;
    }

    .btn-action {
        background-color: var(--color-primary);
        color: var(--color-primary-contrast);
        border: none;
        border-radius: 50px;
        padding: 10px 30px;
        font-weight: 600;
        cursor: pointer;
        text-transform: capitalize;
        transition: opacity 0.2s;
        white-space: nowrap;
    }

    .btn-action:hover {
        opacity: 0.9;
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--color-primary);
        color: var(--color-primary);
        border-radius: 50px;
        padding: 10px 30px;
        font-weight: 600;
        cursor: pointer;
    }
    
    .btn-outline:hover {
        background: rgba(217, 164, 4, 0.1);
    }

    .form-row {
        display: flex;
        gap: 15px;
        align-items: flex-end;
        margin-bottom: 2.5rem;
    }

    .input-wrapper-flex {
        flex-grow: 1;
    }

    .member-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 10px;
    }

    .member-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid var(--color-border-soft);
    }
    
    .member-card:last-child {
        border-bottom: none;
    }

    .member-info-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .avatar-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: var(--color-surface-alt);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: var(--color-text);
        overflow: hidden;
    }
    
    .avatar-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .member-text h4 {
        margin: 0;
        font-size: 1rem;
        color: var(--color-text);
        font-weight: normal;
    }

    .member-role {
        font-size: 0.85rem;
        color: var(--color-primary);
        margin-top: 2px;
    }

    .btn-delete {
        background: none;
        border: none;
        color: var(--color-primary); 
        font-size: 1.2rem;
        cursor: pointer;
        transition: color 0.2s;
    }
    
    .btn-delete:hover {
        color: #ff4444;
    }

    .card-footer {
        margin-top: 40px;
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        border-top: 1px solid var(--color-border-soft);
        padding-top: 30px;
    }

    .appearance-card {
        padding: 28px;
    }

    .theme-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .theme-options {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .theme-choice {
        position: relative;
        display: flex;
        align-items: center;
        gap: 14px;
        border: 1px solid var(--color-border);
        border-radius: 16px;
        padding: 16px;
        color: var(--color-text);
        cursor: pointer;
        background: var(--color-surface);
        transition: border-color 0.2s, transform 0.2s, background-color 0.2s;
    }

    .theme-choice:hover,
    .theme-choice.is-selected {
        border-color: var(--color-primary);
        transform: translateY(-1px);
    }

    .theme-choice input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .theme-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--color-surface-alt);
        color: var(--color-primary);
        flex: 0 0 auto;
        padding-left: 0 !important;
    }

    .theme-icon i {
        width: auto;
        height: auto;
        line-height: 1;
        margin: 0;
        padding-left: 0 !important;
        text-align: center;
    }

    .theme-copy {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding-left: 0 !important;
    }

    .theme-copy strong {
        font-size: 1rem;
        color: var(--color-text);
    }

    .theme-copy span {
        color: var(--color-text-secondary);
        font-size: 0.9rem;
        padding-left: 0;
    }

    @media (max-width: 768px) {
        .settings-card,
        .appearance-card {
            padding: 22px;
        }
        .theme-options {
            grid-template-columns: 1fr;
        }
        .form-row {
            flex-direction: column;
            align-items: stretch;
        }
        .btn-action {
            width: 100%;
        }
        .card-footer {
            flex-direction: column-reverse;
        }
        .card-footer button, .card-footer a {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="config-container">
    <div class="config-header d-flex align-items-center gap-3 mb-4">
        <a href="group/view/<?php echo $grupo['id_grupo']; ?>" style="color: #888; font-size: 1.5rem;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2 class="config-title mb-0"><?php echo htmlspecialchars($grupo['nome_grupo']); ?>: Configuração</h2>
    </div>

    <div class="auth-messages mb-3">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <?php echo htmlspecialchars(urldecode($_GET['error'])); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
            <div class="alert alert-success">
                <i class="fa-solid fa-check"></i> Grupo atualizado com sucesso!
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['status']) && $_GET['status'] == 'theme_updated'): ?>
            <div class="alert alert-success">
                <i class="fa-solid fa-check"></i> Tema atualizado com sucesso!
            </div>
        <?php endif; ?>
    </div>

    <div class="settings-card appearance-card">
        <h3 class="section-label">Aparencia</h3>

        <form class="theme-form" action="<?php echo BASE_URL; ?>user/update" method="POST">
            <input type="hidden" name="type" value="tema">
            <input type="hidden" name="redirect_to" value="group/settings/<?php echo $grupo['id_grupo']; ?>">

            <div class="theme-options" role="radiogroup" aria-label="Escolha do tema">
                <label class="theme-choice <?php echo $currentTheme === 'dark' ? 'is-selected' : ''; ?>">
                    <input type="radio" name="tema" value="dark" <?php echo $currentTheme === 'dark' ? 'checked' : ''; ?>
                           onchange="this.form.submit()">
                    <span class="theme-icon"><i class="bi bi-moon-stars-fill"></i></span>
                    <span class="theme-copy">
                        <strong>Dark Mode</strong>
                        <span>Interface escura para usar com menos brilho.</span>
                    </span>
                </label>

                <label class="theme-choice <?php echo $currentTheme === 'light' ? 'is-selected' : ''; ?>">
                    <input type="radio" name="tema" value="light" <?php echo $currentTheme === 'light' ? 'checked' : ''; ?>
                           onchange="this.form.submit()">
                    <span class="theme-icon"><i class="bi bi-sun-fill"></i></span>
                    <span class="theme-copy">
                        <strong>Light Mode</strong>
                        <span>Interface clara para ambientes iluminados.</span>
                    </span>
                </label>
            </div>
        </form>
    </div>

    <div class="settings-card">
        
        <h3 class="section-label">Detalhes do grupo</h3>
        
        <form id="formUpdateGroup" action="<?php echo BASE_URL; ?>group/update" method="POST">
            <input type="hidden" name="id_grupo" value="<?php echo $grupo['id_grupo']; ?>">
            
            <div class="form-row">
                <div class="input-wrapper-flex">
                    <label class="input-label">Nome do grupo</label>
                    <input type="text" name="nome_grupo" id="groupNameInput" 
                           class="custom-input" 
                           value="<?php echo htmlspecialchars($grupo['nome_grupo']); ?>" 
                           readonly>
                </div>
                <?php if($grupo['id_admin'] == $_SESSION['user_id']): ?>
                    <button type="button" id="btnEnableEdit" class="btn-action">Editar</button>
                <?php endif; ?>
            </div>
        </form>

        <h3 class="section-label">Gerenciar membros do grupo</h3>
        
        <div class="form-row">
            <div class="input-wrapper-flex">
                <label class="input-label">Gere um novo código de acesso</label>
                <input type="text" id="inviteCodeDisplay" 
                       class="custom-input" 
                       value="<?php echo htmlspecialchars($grupo['codigo_convite'] ?? '-----'); ?>" 
                       readonly>
            </div>
            <?php if($grupo['id_admin'] == $_SESSION['user_id']): ?>
                <button type="button" onclick="generateNewCode(<?php echo $grupo['id_grupo']; ?>)" class="btn-action">Gerar</button>
            <?php endif; ?>
        </div>

        <div class="member-list">
            <?php foreach ($membros as $membro): ?>
                <div class="member-card">
                    <div class="member-info-left">
                        <div class="avatar-circle">
                             <?= getInitials($membro['nome']) ?>
                        </div>
                        
                        <div class="member-text">
                            <h4>
                                <?php echo htmlspecialchars($membro['nome']); ?>
                                <?php if ($membro['id_usuario'] == $_SESSION['user_id']) echo ' (Você)'; ?>
                            </h4>
                            
                            <?php if ($membro['id_usuario'] == $grupo['id_admin']): ?>
                                <p class="member-role">Admin do Grupo</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($grupo['id_admin'] == $_SESSION['user_id'] && $membro['id_usuario'] != $_SESSION['user_id']): ?>
                        <form action="<?php echo BASE_URL; ?>group/remove_member" method="POST" 
                              onsubmit="return confirm('Tem certeza que deseja remover este membro?');">
                            <input type="hidden" name="id_grupo" value="<?php echo $grupo['id_grupo']; ?>">
                            <input type="hidden" name="id_membro" value="<?php echo $membro['id_usuario']; ?>">
                            <button type="submit" class="btn-delete" title="Remover membro">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="card-footer">
            <a href="group/view/<?php echo $grupo['id_grupo']; ?>" class="btn-outline" style="text-decoration: none; display: inline-block; text-align:center;">Cancelar</a>
            
            <?php if($grupo['id_admin'] == $_SESSION['user_id']): ?>
                <button type="button" onclick="document.getElementById('formUpdateGroup').submit()" class="btn-action">Salvar</button>
            <?php endif; ?>
        </div>

    </div>
</div>

<script>
    const BASE_URL = "<?php echo BASE_URL; ?>";

    document.addEventListener("DOMContentLoaded", () => {
        const btnEdit = document.getElementById('btnEnableEdit');
        const inputName = document.getElementById('groupNameInput');

        if(btnEdit && inputName) {
            btnEdit.addEventListener('click', () => {
                inputName.readOnly = false;
                inputName.focus();
                inputName.style.borderColor = 'var(--color-primary)';
                btnEdit.style.display = 'none'; 
            });
        }
    });

    async function generateNewCode(groupId) {
        const inputDisplay = document.getElementById('inviteCodeDisplay');
        const originalValue = inputDisplay.value;
        
        inputDisplay.value = "Gerando...";
        
        try {
            const response = await fetch(BASE_URL + 'group/generateInviteCode/' + groupId, {
                method: 'POST'
            });
            const data = await response.json();

            if (data.success) {
                inputDisplay.value = data.code;
            } else {
                alert('Erro: ' + (data.error || 'Falha desconhecida'));
                inputDisplay.value = originalValue;
            }
        } catch (error) {
            console.error(error);
            alert('Erro de conexão.');
            inputDisplay.value = originalValue;
        }
    }
</script>
<?php require_once '../views/components/footer.php'; ?>
