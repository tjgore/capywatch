import PropTypes from 'prop-types';
import Hat from "../Icons/Hat";
import dayjs from "dayjs";

export default function Card({ observation }) {
  return (
    <div
    className="border border-gray-300 rounded-md p-5"
  >
    <div className="flex flex-col items-center mb-3">
      <div className="h-8 w-8 rounded-full bg-orange-500 flex items-center justify-center">
        {observation.has_hat ? (
          <Hat className="h-5 w-5" />
        ) : null}
      </div>
      <h4 className=" font-semibold text-lg">
        {observation.capybara.name}
      </h4>
    </div>

    <div className="flex flex-row gap-4 justify-center">
      <p>City: {observation.city.name}</p>
      <p>Observed At: {dayjs(observation.observed_at).format('MMM D, YYYY')}</p>
    </div>
  </div>
  );
}

Card.propTypes = {
  observation: PropTypes.shape({
    has_hat: PropTypes.oneOf([1, 0]),
    capybara: PropTypes.shape({
      name: PropTypes.string.isRequired,
    }).isRequired,
    city: PropTypes.shape({
      name: PropTypes.string.isRequired,
    }).isRequired,
    observed_at: PropTypes.string.isRequired,
  }).isRequired,
};
