import AppLayout from "../../components/Layouts/AppLayout";
import { useQuery } from "@tanstack/react-query";
import Loading from "./Loading";
import Empty from "./Empty";
import { default as ObservationCard } from "../../components/Observations/Card";
import Error from "../../components/Error";
import CreateForm from "../../components/Observations/CreateForm";
import { getCreateFormAndObservations } from "../../api";

export default function Observations() {
  const { data, isLoading, isError, refetch } = useQuery({
    queryKey: ["observations-page"],
    queryFn: () => getCreateFormAndObservations(),
    keepPreviousData: true,
  });

  const { observations, createForm } = data || {};

  return (
    <AppLayout>
      <div>
        {!isLoading && !isError ? (
          <CreateForm
            refetch={refetch}
            capybaras={createForm.capybaras}
            cities={createForm.cities}
          />
        ) : null}

        <h1 className="text-2xl font-bold mb-5">Observations</h1>
        <div className="mb-20">
          {isLoading ? (
            <div className="grid grid-cols-1 lg:grid-cols-3 gap-5">
              <Loading />
            </div>
          ) : null}
          {isError ? (
            <Error message="Something went wrong. Try reloading or contact support" />
          ) : null}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-5">
            {observations
              ? observations.map((observation) => (
                  <ObservationCard
                    key={observation.id}
                    observation={observation}
                  />
                ))
              : null}
          </div>
          {!isLoading && observations && observations.length === 0 ? (
            <Empty />
          ) : null}
        </div>
      </div>
    </AppLayout>
  );
}
