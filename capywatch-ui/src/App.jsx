import {
  BrowserRouter as Router,
  Route,
  Routes,
} from "react-router-dom";
import {
  QueryClient,
  QueryClientProvider,
} from "@tanstack/react-query";
import NotFound from './pages/NotFound';
import Observations from "./pages/Observations";
import Capybaras from "./pages/Capybaras";

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      retry: import.meta.env.MODE === 'production',
      refetchOnWindowFocus: import.meta.env.MODE === 'production',
    },
  },
});

function App() {
  return (
    <div className="min-h-screen overflow-x-hidden font-sans text-sm text-gray-700 antialiased">
      <QueryClientProvider client={queryClient}>
      <Router basename="/">         
            <Routes>
              <Route path="/" element={<Observations />} />
              <Route path="/capybaras" element={<Capybaras />} />
              <Route path="*" element={<NotFound />} />
            </Routes>
      </Router>
    </QueryClientProvider>
    </div>
  )
}

export default App
