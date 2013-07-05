require 'spec_helper'

describe ProjectDecorator do
  describe ".address" do
    let(:decorated) { create(:project, {street: "Slobodskaya 91", city: "Minsk", country: "Belarus"}).decorate }

    it { expect(decorated.address).to eq("Slobodskaya 91 Minsk Belarus") }
  end
end