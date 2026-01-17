<!-- Modal -->
<div class="modal fade" id="LogoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content neon-modal">
            <div class="modal-header neon-header">
                <h5 class="modal-title" id="ModalCenterTitle">Logout?</h5>
                <button type="button" class="close neon-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body neon-body">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn neon-btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn neon-btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Neon Modal Style */
    .neon-modal {
        background: #1a1a1a;
        border-radius: 15px;
        box-shadow: 0 0 20px #4facfe, 0 0 40px #00f2fe;
        color: #fff;
    }

    /* Header */
    .neon-header {
        background: linear-gradient(135deg, #ff6ec4, #7873f5);
        color: #fff;
        box-shadow: 0 0 10px #ff6ec4, 0 0 20px #7873f5;
    }

    /* Close button */
    .neon-close span {
        color: #fff;
        text-shadow: 0 0 5px #ff6ec4, 0 0 10px #7873f5;
    }

    .neon-close:hover span {
        color: #fff;
        text-shadow: 0 0 15px #ff6ec4, 0 0 25px #7873f5;
    }

    /* Modal Body */
    .neon-body {
        color: #fff;
        text-align: center;
        font-weight: 500;
    }

    /* Buttons */
    .neon-btn-primary {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        color: #fff;
        font-weight: 600;
        border: none;
        padding: 8px 20px;
        border-radius: 25px;
        box-shadow: 0 0 5px #4facfe, 0 0 10px #00f2fe, 0 0 20px #00f2fe;
        transition: all 0.3s ease-in-out;
    }

    .neon-btn-primary:hover {
        box-shadow: 0 0 10px #4facfe, 0 0 20px #00f2fe, 0 0 30px #00f2fe;
        transform: scale(1.05);
    }

    .neon-btn-secondary {
        background: linear-gradient(135deg, #ff6ec4, #7873f5);
        color: #fff;
        font-weight: 600;
        border: none;
        padding: 8px 20px;
        border-radius: 25px;
        box-shadow: 0 0 5px #ff6ec4, 0 0 10px #7873f5, 0 0 20px #7873f5;
        transition: all 0.3s ease-in-out;
    }

    .neon-btn-secondary:hover {
        box-shadow: 0 0 10px #ff6ec4, 0 0 20px #7873f5, 0 0 30px #ff6ec4;
        transform: scale(1.05);
    }
</style>
