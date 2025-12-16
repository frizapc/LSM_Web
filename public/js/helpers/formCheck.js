const formCheck = {
    init(form) {
        this.initialState = getFormData(form);
    },

    getFormData(form) {
        const data = {};
        new FormData(form).forEach((value, key) => {
            data[key] = value.trim();
        });
        return data;
    },

    isChanged(form) {
        const currentState = getFormData(form);
        return isFormChanged(this.initialState, currentState);
    },

    isFormChanged(initial, current) {
        const keys = Object.keys(initial);

        return keys.some((key) => initial[key] !== current[key]);
    },

    submitGuard(form, onSubmit) {
        if (!this.isChanged(form)) {
            alert("Tidak ada perubahan data");
            return;
        }

        onSubmit();
    },
};
