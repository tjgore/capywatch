import { useState } from "react";
import { useForm } from "laravel-precognition-react";
import PropTypes from "prop-types";

export default function CreateForm({ refetch, cities, capybaras }) {
  const [alert, setAlert] = useState(null);

  const form = useForm("post", `${import.meta.env.VITE_API_URL}/observations`, {
    capybara_id: "",
    city_id: "",
    observed_at: "",
    has_hat: 0,
  });

  const onSubmit = async (e) => {
    e.preventDefault();

    try {
      await form.submit();
      form.reset();
      setAlert({
        message: "Observation created successfully",
        type: "success",
      });
      refetch();
    } catch (error) {
      setAlert({
        message: "An error occurred. Please try again.",
        type: "error",
      });
    }
  };

  const instantValidate = (e) => {
    form.setData(e.target.name, e.target.value);
    form.validate(e.target.name);
  };

  const handleCheckbox = (e) => {
    form.setData(e.target.name, e.target.checked ? 1 : 0);
    form.validate(e.target.name);
  };

  const invalidClass = (field) => {
    return form.invalid(field) ? "border-red-500" : "border-gray-300";
  };

  const cannotSubmit = form.processing || form.hasErrors;

  return (
    <>
      <h1 className="text-2xl font-bold mb-5">Create Observations</h1>
      <div className="mb-20">
        <div className="max-w-none lg:max-w-xl p-7 border rounded-md border-gray-300">
          <form onSubmit={onSubmit}>
            {form.hasErrors && <div></div>}
            <div className="mb-4">
              <label htmlFor="capybara_id" className="block mb-2 font-medium">
                Capybara Name{" "}
                <span className="text-red-500 text-xs">* required</span>
              </label>
              <select
                id="capybara_id"
                className={`w-full border rounded-md p-2 ${invalidClass(
                  "capybara_id"
                )}`}
                name="capybara_id"
                value={form.data.capybara_id}
                onChange={(e) => instantValidate(e)}
              >
                <option value="">Select a capybara</option>
                {capybaras &&
                  capybaras.map((capybara) => (
                    <option key={capybara.id} value={capybara.id}>
                      {capybara.name}
                    </option>
                  ))}
              </select>
              {form.invalid("capybara_id") && (
                <p className="text-red-500 text-xs pt-1">
                  {form.errors.capybara_id}
                </p>
              )}
            </div>
            <div className="mb-4">
              <label htmlFor="city_id" className="block mb-2 font-medium">
                City <span className="text-red-500 text-xs">* required</span>
              </label>
              <select
                id="city_id"
                className={`w-full border rounded-md p-2 ${invalidClass(
                  "city_id"
                )}`}
                name="city_id"
                value={form.data.city_id}
                onChange={(e) => instantValidate(e)}
              >
                <option value="">Select a city</option>
                {cities &&
                  cities.map((city) => (
                    <option key={city.id} value={city.id}>
                      {city.name}
                    </option>
                  ))}
              </select>
              {form.invalid("city_id") && (
                <p className="text-red-500 text-xs pt-1">
                  {form.errors.city_id}
                </p>
              )}
            </div>
            <div className="mb-4">
              <label htmlFor="observed_at" className="block mb-2 font-medium">
                Observed At
                <span className="text-red-500 text-xs">* required</span>
              </label>
              <input
                id="observed_at"
                className={`w-full border rounded-md p-2 ${invalidClass(
                  "observed_at"
                )}`}
                type="date"
                name="observed_at"
                value={form.data.observed_at}
                onChange={(e) => form.setData("observed_at", e.target.value)}
                onBlur={() => form.validate("observed_at")}
              />
              {form.invalid("observed_at") && (
                <p className="text-red-500 text-xs pt-1">
                  {form.errors.observed_at}
                </p>
              )}
            </div>
            <div className="mb-4 py-2">
              <div className="flex flex-row items-center">
                <input
                  id="has_hat"
                  className={`border rounded-md p-2 mr-3 ${invalidClass(
                    "has_hat"
                  )}`}
                  type="checkbox"
                  name="has_hat"
                  checked={form.data.has_hat ? true : false}
                  value={form.data.has_hat}
                  onChange={(e) => handleCheckbox(e)}
                />
                <label
                  htmlFor="has_hat"
                  className="select-none block font-medium"
                >
                  Has a hat
                </label>
              </div>
              {form.invalid("has_hat") && (
                <p className="text-red-500 text-xs pt-1">
                  {form.errors.has_hat}
                </p>
              )}
            </div>

            <div className="w-full flex justify-end items-center gap-3">
              <button
                type="submit"
                disabled={cannotSubmit}
                className={`${
                  cannotSubmit
                    ? "opacity-50 cursor-not-allowed"
                    : "cursor-pointer"
                } px-5 py-2 border text-base rounded-md bg-blue-600 hover:opacity-90 text-white font-medium `}
              >
                Create
              </button>
              <button
                type="button"
                onClick={() => form.reset()}
                className="cursor-pointer px-5 py-2 border text-base rounded-md bg-white hover:bg-gray-100 font-medium"
              >
                Cancel
              </button>
            </div>
            <div>
              <div className="h-4">
                {alert && (
                  <p
                    className={`${
                      alert.type === "success" && "text-green-500 font-semibold"
                    } ${
                      alert.type === "error" && "text-red-500 font-semibold"
                    }`}
                  >
                    {alert.message}
                  </p>
                )}
              </div>
            </div>
          </form>
        </div>
      </div>
    </>
  );
}

CreateForm.propTypes = {
  refetch: PropTypes.func.isRequired,
  cities: PropTypes.arrayOf(
    PropTypes.shape({
      id: PropTypes.number.isRequired,
      name: PropTypes.string.isRequired,
    })
  ).isRequired,
  capybaras: PropTypes.arrayOf(
    PropTypes.shape({
      id: PropTypes.number.isRequired,
      name: PropTypes.string.isRequired,
    })
  ).isRequired,
};
