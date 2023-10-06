import PropTypes from 'prop-types';
import { NavLink } from 'react-router-dom';

export default function AppLayout({ children }) {
  return (
    <div>
      <nav className="max-w-6xl m-auto grid grid-cols-1 lg:grid-cols-2 py-5 px-5">
      <div className="flex items-center justify-center pb-4 lg:pb-0 lg:justify-start">
        <svg
          className="h-6 w-6"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512"
        >
          <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256-96a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
        </svg>
        <p className="font-black text-3xl pl-1"><span className="text-orange-500">Capy</span>Watch</p>
      </div>

      <ul className="flex items-center justify-center flex-row gap-6 font-semibold text-base">
        <li>
          <NavLink
            to="/"
            className={({ isActive }) =>
              isActive ? "text-blue-700" : "text-gray-800"
            }
          >
            Observations
          </NavLink>
        </li>
        <li>
          <NavLink
            to="/capybaras"
            className={({ isActive }) =>
              isActive ? "text-blue-700" : "text-gray-800"
            }
          >
            Capybaras
          </NavLink>
        </li>
      </ul>
    </nav>
      <main className="max-w-6xl m-auto py-10 px-5">{children}</main>
    </div>
  );
}

AppLayout.propTypes = {
  children: PropTypes.node.isRequired,
};
