<template id="template-checklist-form">
    <form class="form-checklist d-flex flex-column gap-3 mb-3 create">
        <input type="hidden" name="dev_id" class="devId" value="">
        <input type="hidden" name="id" class="checkdevId" value="">
        <input type="hidden" name="category" class="category-value" value="">
        <input type="hidden" name="status" class="checklist-status-hidden" value="">
        <div class="form-check checklist-item form-check-solid">
            <input type="checkbox" class="form-check-input checklist-status-toggle">
            <input type="hidden" name="name" class="checklist-hidden-title" />
            <div class="form-check-label checklist-editable"
                contenteditable="true"
                spellcheck="false"
                style="width: 100%; outline: none;"
                onfocus="this.style.backgroundColor='#fff5f5'; this.style.borderRadius='0.475rem'; this.style.padding='0.5rem';"
                onblur="this.style.backgroundColor=''; this.style.padding='0';">
            </div>
        </div>
        <div class="d-flex gap-3 checklist-action-buttons">
            <button type="button" onclick="submitCheckdev({el: this})" class="btn btn-sm tbr_btn tbr_btn--primary btn-save-checklist">Tambah</button>
            <button type="button" onclick="updateCheckdev({el: this})" class="btn btn-sm tbr_btn tbr_btn--primary btn-update-checklist d-none">Simpan</button>
            <button type="button" onclick="cancelChecklistForm(this)" class="btn btn-sm btn-secondary btn-cancel-checklist">Batal</button>
            <button type="button" onclick="deleteCheckdev(this)" class="btn btn-sm btn-secondary btn-delete-checklist d-none">Hapus</button>
        </div>
    </form>
</template>
