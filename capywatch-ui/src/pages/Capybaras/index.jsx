import AppLayout from "../../components/Layouts/AppLayout";

export default function Capybaras() {
  return (
    <AppLayout>
      <div>
        <h1 className="text-2xl font-bold mb-5">Capybaras</h1>
        <div>
            <div className="grid grid-cols-1 lg:grid-cols-3 gap-5">
              <div className="border border-gray-300 rounded-md p-5">
                <div className="flex flex-row items-center mb-3">
                <h4 className=" font-semibold text-lg">Steven the Capybara</h4>
                <div className={`ml-4 h-5 w-5 rounded-full bg-[#892]`}/>
                </div>
                
                <div className="flex flex-row gap-4">
                  <p>Height: 20 inches</p>
                  <p>Length: 40 inches</p>
                </div>
              </div>
            </div>
        </div>
      </div>
    </AppLayout>
  );
}
