require 'spec_helper'

describe ProjectDecorator do
  describe ".address" do
    let(:decorated) { create(:project, {street: "Slobodskaya 91", city: "Minsk", country: "Belarus"}).decorate }

    it { expect(decorated.address).to eq("Slobodskaya 91 Minsk Belarus") }
  end

  describe ".days_to_close" do
    let(:decorated) { create(:project, finish_investment: 2.days.from_now).decorate }

    it { expect(decorated.days_to_close).to eq(2) }
  end
end
