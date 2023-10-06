import { Link } from "react-router-dom";
import PropTypes from 'prop-types';

export default function Error({ homeLink, message }) {
  return (
    <div className="flex flex-col items-center justify-center h-56">
      <h1 className="text-6xl font-black pb-2">Error</h1>
      <div className="pb-5">
        <p className=" max-w-xs text-center font-bold">{message}</p>
        {homeLink && <Link to="/" className="w-full block text-blue-500 hover:underline text-center">Go back to home</Link>}
      </div>
    </div>
  );
}

Error.propTypes = {
  homeLink: PropTypes.bool,
  message: PropTypes.string.isRequired,
};
