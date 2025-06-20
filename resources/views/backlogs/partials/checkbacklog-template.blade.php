<template class="template-checklist-form">
    <form class="form-checklist d-flex flex-column gap-3 mb-3 create"
        action="{{ route('check-backlog.store') }}"
        method="POST"
        data-success-callback="checklistSaved"
        data-complete-callback="resetChecklistForm"
        data-check-backlog-id="{{ $checkBacklog->id ?? '' }}"
        onsubmit="document.querySelector('.checklist-hidden-title').value = document.querySelector('.checklist-editable').innerText.trim();
            event.preventDefault();
            submitAjax({ el: this.querySelector('button[type=submit]') });">
        @csrf
        <input type="hidden" name="backlog_id" class="backlog-id-field" value="{{ $backlog->id ?? '' }}">
        <input type="hidden" name="id" class="checkBacklogId" value="{{ $backlog->id ?? '' }}">
        <div class="form-check checklist-item form-check-solid">
            <input type="checkbox"
                class="form-check-input checklist-status-toggle"
                data-id="{{ $checkBacklog->id ?? '' }}"
                {{ ($checkBacklog->status ?? '') === 'active' ? 'checked' : '' }}>
            <input type="hidden" name="name" class="checklist-hidden-title" />
            <div class="form-check-label checklist-editable"
                contenteditable="true"
                spellcheck="false"
                style="width: 100%; outline: none;"
                onfocus="this.style.backgroundColor='#fff5f5'; this.style.borderRadius='0.475rem'; this.style.padding='0.5rem';"
                onblur="this.style.backgroundColor=''; this.style.padding='0';">
            </div>
        </div>
        <div class="d-flex gap-3 checklist-action-buttons d-none">
            <button type="button" onclick="submitCheckbacklog({el: this})" class="btn btn-sm tbr_btn tbr_btn--primary btn-save-checklist">Tambah</button>
            <button type="button" onclick="updateCheckbacklog({el: this})" class="btn btn-sm tbr_btn tbr_btn--primary btn-update-checklist d-none">Simpan</button>
            <button type="button" onclick="cancelCheckbacklog(this)" class="btn btn-sm btn-secondary btn-cancel-checklist">Batal</button>
            <button type="button" onclick="deleteCheckbacklog(this)" class="btn btn-sm btn-secondary btn-delete-checklist d-none">Hapus</button>
        </div>
    </form>
</template>
