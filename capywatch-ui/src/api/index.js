function getObservations() {
  return fetch(`${import.meta.env.VITE_API_URL}/observations`).then((res) =>
    res.json()
  );
}

function getCreateForm() {
  return fetch(`${import.meta.env.VITE_API_URL}/observations/create`).then(
    (res) => res.json()
  );
}

export function getCreateFormAndObservations() {
  return Promise.all([getCreateForm(), getObservations()]).then(
    ([createForm, observations]) => ({
      createForm,
      observations,
    })
  );
}
